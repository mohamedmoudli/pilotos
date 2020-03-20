<?php

namespace App\Controller;


use App\Entity\AccessToken;
use App\Entity\User;
use App\Entity\User1;
use App\Service\AouthService;
use App\Service\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Controller\RegistrationController;
use FOS\UserBundle\Controller\ResettingController;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Util\TokenGeneratorInterface;
use OAuth2\IOAuth2;
use OAuth2\OAuth2;
use OAuth2\OAuth2ServerException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\SwitchUserToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Json;


class UserController extends AbstractController
{
    private $userManager;
    private $encoderFactory;
    private $ioauth;
    private $aouthservice;

    public function __construct(UserManager $userManager, EncoderFactoryInterface $encoderFactory)
    {
        $this->userManager = $userManager;
        $this->encoderFactory = $encoderFactory;

    }


    /**
     * @Route("/register1", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        if ($request->isMethod('POST')) {
            $user = new User();
            $user->setEmail($request->request->get('email'));
            $user->setUsername($request->request->get('username'));
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);

            $em->flush();
            return new JsonResponse('success');
        }

        return new JsonResponse('error1');
    }








    /**
     * @Route("/signin", name="signin")
     */
    public function loginAction(Request $request , OAuth2 $oauth2)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        /** @var User $user */

        $user = $this->userManager->getUserByEmail($email);
        $encoder = $this->encoderFactory->getEncoder($user);
        $bool = $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());
//
        if (!$user instanceof User || !$bool) {
            return new JsonResponse(['message' => 'Invalid credentials'], 500);
        }

        if (!$user->isEnabled()) {
            return new JsonResponse(['message' => 'User account is disabled.'], 500);
        }


        return new JsonResponse($this->getAuth2Token($user, $request ,  $oauth2));
    }

    /**
     * @Route("/signup", name="signup")
     */
    public function signUpAction(Request $request , RegistrationController $registrationController , AouthService $aouthService)
    {
        return $aouthService->signup($request);
    }

    /**
     * @Route("/token/refresh/{id}", name="token_refresh")
     * @ParamConverter("id", options={"id": "id"})
     */
    public function refreshTokenAction(Request $request, User $user ,OAuth2 $oauth2)
    {
        return new JsonResponse($this->getRefreshToken($request, $user , $oauth2));
    }

    protected function getRefreshToken(Request $request, User $user , OAuth2 $oauth2)
    {
        $em = $this->getDoctrine()->getManager();
        $refreshToken = $request->get('refresh_token');
        $token = $request->get('token');

        /** @var AccessToken $accessToken */
        $accessToken = $em->getRepository(AccessToken::class)->findOneBy(array('user' => $user, 'token' => $token));
        if (!is_null($accessToken)) {
            if (isset($accessToken->getAttributes()['refresh_token'])) {
                if ($token == $accessToken->getAttributes()['access_token']) {
                    $request2 = new Request();
                    $request2->query->add([
                        'client_id' => $this->getParameter('oauth2_client_id'),
                        'client_secret' => $this->getParameter('oauth2_client_secret'),
                        'grant_type' => 'refresh_token',
                        'refresh_token' => $refreshToken
                    ]);

                    $createToken = json_decode($this->$oauth2->grantAccessToken($request2)->getContent(), true);
                    $newToken = $createToken['access_token'];
                    $newAccessToken = $em->getRepository(AccessToken::class)->findOneBy(array('user' => $user, 'token' => $newToken));
                    $attributes = $accessToken->getAttributes();
                    $attributes['expires_at'] = (new \DateTime())->getTimestamp() + $this->getParameter('token_lifetime');
                    $ids = array();
                    $ids[] = $accessToken->getId();
                    $ids[] = $newAccessToken->getId();
                    if (isset($attributes['all_id'])) {

                        $attributes['all_id'] = array_merge($attributes['all_id'], $ids);
                    } else {
                        $attributes['all_id'] = $ids;
                    }
                    $attributes['all_id'] = array_unique($attributes['all_id']);
                    if (isset($attributes['access_token'])) {
                        unset($attributes['access_token']);
                    }
                    if (isset($attributes['refresh_token'])) {
                        unset($attributes['refresh_token']);
                    }
                    $attributes = array_merge($attributes, $createToken);
                    foreach ($attributes['all_id'] as $id) {
                        $access = $em->find(AccessToken::class, $id);
                        $em->persist($access->setAttributes($attributes));
                    }

                    $em->persist($newAccessToken->setAttributes($attributes));

                    $em->flush();
                    try {
                        return array_merge($createToken, array(
                                'expires_at' => (new \DateTime())->getTimestamp() + $this->getParameter('token_lifetime'),
                                'user_id' => $user->getId(),

                                'email' => $user->getEmail(),

                            )
                        );
                    } catch (OAuth2ServerException $e) {
                        return $e->getHttpResponse();
                    }
                } elseif ((new \DateTime())->getTimestamp() + 120 >= $accessToken->getAttributes()['expires_at']) {
                    $request2 = new Request();
                    $request2->query->add([
                        'client_id' => $this->getParameter('oauth2_client_id'),
                        'client_secret' => $this->getParameter('oauth2_client_secret'),
                        'grant_type' => 'refresh_token',
                        'refresh_token' => $accessToken->getAttributes()['refresh_token']
                    ]);

                    $createToken = json_decode($this->$oauth2->grantAccessToken($request2)->getContent(), true);
                    $newToken = $createToken['access_token'];
                    $newAccessToken = $em->getRepository(AccessToken::class)->findOneBy(array('user' => $user, 'token' => $newToken));
                    $attributes = $accessToken->getAttributes();
                    $attributes['expires_at'] = (new \DateTime())->getTimestamp() + $this->getParameter('token_lifetime');
                    $ids = array();
                    $ids[] = $accessToken->getId();
                    $ids[] = $newAccessToken->getId();
                    if (isset($attributes['all_id'])) {

                        $attributes['all_id'] = array_merge($attributes['all_id'], $ids);
                    } else {
                        $attributes['all_id'] = $ids;
                    }
                    if (isset($attributes['access_token'])) {
                        unset($attributes['access_token']);
                    }
                    if (isset($attributes['refresh_token'])) {
                        unset($attributes['refresh_token']);
                    }
                    $attributes['all_id'] = array_unique($attributes['all_id']);
                    $attributes = array_merge($attributes, $createToken);
                    foreach ($attributes['all_id'] as $id) {
                        $access = $em->find(AccessToken::class, $id);
                        $em->persist($access->setAttributes($attributes));
                    }
                    $em->persist($newAccessToken->setAttributes($attributes));
                    $em->flush();
                    try {
                        return array_merge($createToken
                            , array(
                                'expires_at' => (new \DateTime())->getTimestamp() + $this->getParameter('token_lifetime'),
                                'user_id' => $user->getId(),

                            )
                        );
                    } catch (OAuth2ServerException $e) {
                        return $e->getHttpResponse();
                    }
                } else {
                    $attributes = $accessToken->getAttributes();

                    try {
                        return array_merge(
                            array('access_token' => $attributes['access_token'],
                                'refresh_token' => $attributes['refresh_token'],
                                'expires_at' => $attributes['expires_at']), array(
                                'expires_at' => (new \DateTime())->getTimestamp() + $this->getParameter('token_lifetime'),
                                'user_id' => $user->getId(),

                            )
                        );
                    } catch (OAuth2ServerException $e) {
                        return $e->getHttpResponse();
                    }
                }
            } else {
                $request2 = new Request();
                $request2->query->add([
                    'client_id' => $this->getParameter('oauth2_client_id'),
                    'client_secret' => $this->getParameter('oauth2_client_secret'),
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken
                ]);


                try {
                    return array_merge(
                        json_decode(
                            $oauth2
                                ->grantAccessToken($request2)
                                ->getContent(), true
                        ), array(
                            'expires_at' => (new \DateTime())->getTimestamp() + $this->getParameter('token_lifetime'),
                            'user_id' => $user->getId(),

                        )
                    );
                } catch (OAuth2ServerException $e) {
                    return $e->getHttpResponse();
                }
            }
        } else {
            $response = new Response();
            $response->setContent(json_encode(array(
                'message' => 'Session expired',
                'error' => '401'
            )));

            return $response;
        }
    }

    /**
     * @Route("/check-email-to-reset/{email}", name="check_email_to_reset")
     */
    public function checkEmailToResetAction($email ,   \Swift_Mailer $mailer)
    {

        $um = $this->getUserManager();
        $user = $um->findUserByEmail($email);

        if (!$user instanceof User) {
            return new JsonResponse(['isValid' => false], 200);
        }

        /** @var $tokenGenerator TokenGeneratorInterface */
        $user->setConfirmationToken($tokenGenerator->generateToken());

        // send resetting email
        $data = "<a href='" . $this->container->getParameter("front_url") . "session/reset/" . $user->getConfirmationToken() . "'>Reset</a>";
        $this->container->get('app.send_email')->send('d8dbd',  [$user->getEmail(), $this->container->getParameter('mailer_test_address')], null, null, [], ['email' =>$email, 'resettingLink' => $data, 'url' => $this->container->getParameter("front_url")]);

        $user->setPasswordRequestedAt(new \DateTime());
        /** @var $userManager UserManagerInterface */
        $userManager->updateUser($user);


        return new JsonResponse(['isValid' => true], 200);
    }

    /**
     * @Route("/reset_password/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request,string $token, UserPasswordEncoderInterface $passwordEncoder)
    {

        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->findOneByResetToken($token);
            /* @var $user User */

            if ($user === null) {
                return new JsonResponse('Unknown Token',500);
            }

            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager->flush();

            return new JsonResponse('password updated',200);
        }else {

            return new JsonResponse('Not allowed',500);

        }

    }


    /**
     * @Route("/forgotten_password", name="app_forgotten_password")
     */
    public function forgottenPassword(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        \Swift_Mailer $mailer,
        TokenGeneratorInterface $tokenGenerator
    ): Response
    {

        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');

            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);
            /* @var $user User */

            if ($user === null) {
                return  new JsonResponse('Email Inconnu',500);
            }
            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return  new JsonResponse('false',500);
            }

            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new \Swift_Message('Forgot Password'))
                ->setFrom('mohamedmouldi95@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    "le token pour reseter votre mot de passe : " . $url,
                    'text/html'
                );

           $res = $mailer->send($message);

            dump($res);
            $this->addFlash('notice', 'Mail envoyé');
            return  new JsonResponse('true',200);
        }

        return new JsonResponse('false',500);
    }







    /**
     * @Route("/activate", name="activate_user")
     */
    public function activateAction(Request $request)
    {

        $token = $request->get('token');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->findUserByConfirmationToken($token);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with "confirmation token" does not exist for value "%s"', $token));
        }

        /** @var $tokenGenerator TokenGeneratorInterface */
        $tokenGenerator = $this->get('fos_user.util.token_generator');
        $user->setConfirmationToken($tokenGenerator->generateToken());

        $user->setEnabled(true);
        $userManager->updateUser($user);

        return new Response('true', 200);
    }

    protected function getAuth2Token(User $user, Request $request,OAuth2 $oauth2)
    {
        $request2 = new Request();
        $request2->query->add([
            'client_id' => $this->getParameter('oauth2_client_id'),
            'client_secret' => $this->getParameter('oauth2_client_secret'),
            'grant_type' => 'password',
            'username' => $user->getUsername(),
            'password' => $request->get('password')
        ]);
        try {
            return new JsonResponse(array_merge(
                json_decode(
                    $oauth2
                        ->grantAccessToken($request2)
                        ->getContent(), true
                ), array(
                    'expires_at' => (new \DateTime())->getTimestamp() + $this->getParameter('token_lifetime'),
                    'user_id' => $user->getId(),
                    'email' => $user->getEmail(),
                )
            ));
        } catch (OAuth2ServerException $e) {
            return new JsonResponse($e->getHttpResponse());
        }
    }


    protected function getUserManager()
    {
        return $this->get('pugx_user_manager');
    }


    /**
     * @Route("/api/core-users/check-unique-by-email/{email}",
     *     name="core_users_check_unique_email",
     *     requirements={
     *          "email"=".+"
     *      }
     * )
     * @Method({"GET"})
     */
    public function checkUniqueEmailAction($email)
    {
        $em = $this->getDoctrine()->getManager();
        $coreUser = $em->getRepository(User::class)->findOneBy(array(
            'email' => $email
        ));

        return new JsonResponse(array(
            'isUnique' => is_null($coreUser)
        ));
    }

    /**
     * @Route(
     *     name="api_edit_users",
     *     path="/api/core-users/{id}/edit",
     *     methods={"PUT"},
     *     defaults={
     *          "_api_resource_class"=CoreUser::class,
     *          "_api_operation_name"="api_edit_users"
     *      }
     *  )
     */
    public function editAction(Request $request, User $coreUser)
    {
        $content = json_decode($request->getContent());

        $coreUser->setEmail($content->email)
            ->setUsername($coreUser->getEmail());
        if (!is_null($content->password)) {
            $coreUser->setPlainPassword($content->password);
            $userManager = $this->container->get('fos_user.user_manager');
            $userManager->updatePassword($coreUser);
        }

        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $doctrine->getConnection()->beginTransaction();
        try {

            if (isset($content->logo)) {

                $selectedOrganization = $request->get('selectedOrganization');
                $organization = $em->find(User::class, $selectedOrganization);
                $bucket = $this->container->getParameter('public_bucket');
                $region = $this->container->getParameter('region');
                $file_name = 'logo.png';
                $fullName = 'logo/' . $selectedOrganization. '/'. $file_name;
                $this->get('aws.s3')->uploadFile($fullName,  base64_decode($content->logo->value), true);
                $organization->setLogo( 'https://' . $bucket . '.s3.' . $region . '.amazonaws.com/' . $fullName);
                $em->persist($organization);
            }

            $em->persist($coreUser);
            $em->flush();
            $doctrine->getConnection()->commit();
            return new Response('', 201);
        } catch (\Exception $e) {
            $doctrine->getConnection()->rollBack();
            $response = new Response();

            $response->setContent(json_encode(array(
                'message' => $e->getMessage()
            )));
            $response->setStatusCode(500);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

    /**
     * @Route(
     *     name="verify-currentPassword",
     *     path="/core-users/verify-currentPassword/{id}",
     *     methods={"POST"},
     * )
     */
    public function verifyCurrentPassword(User $coreUser, Request $request)
    {
        try {
            $content = json_decode($request->getContent());
            $currentPassword=$content->valueToCheck;
            dump($currentPassword);
            /** @var EncoderFactoryInterface $factory */
            $encoder = $factory->getEncoder($coreUser);

            $bool = $encoder->isPasswordValid($coreUser->getPassword(), $currentPassword, $coreUser->getSalt());
            dump($bool);
            return new JsonResponse(array(
                'verify' => $bool
            ));


        } catch (\Exception $e) {
            $response = new Response();
            $response->setContent(json_encode(array(
                'message' => $e->getMessage()
            )));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

    /**
     * @Route(
     *     name="clear_token",
     *     path="/core-users/{id}/clear_token",
     *     methods={"GET"},
     *     defaults={"_api_resource_class"=CoreUser::class, "_api_operation_name"="clear_token"}
     * )
     */
    public function clearTokenAction(User $user ,OAuth2 $oauth2)
    {
        $em = $this->getDoctrine()->getManager();
        $token = $oauth2->getBearerToken();
        $accessToken = $em->getRepository(AccessToken::class)->findOneBy(array('user' => $user, 'token' => $token));
        $ids = array();
        $ids[] = $accessToken->getId();
        if (isset($accessToken->getAttributes()['all_id'])) {
            $ids = array_merge($ids, $accessToken->getAttributes()['all_id']);
            foreach ($accessToken->getAttributes()['all_id'] as $id) {
                $access = $em->find(AccessToken::class, $id);
                $em->remove($access);
            }
        };
        $em->remove($accessToken);
        $em->flush();
        return new JsonResponse($ids, 200);
    }

    /**
     * @Route(
     *     name="api_get_details_user",
     *     path="/api/core-users/{id}/getDetails",
     *     methods={"GET"},
     *     defaults={
     *          "_api_resource_class"=CoreUser::class,
     *          "_api_operation_name"="api_get_details_user"
     *      }
     *  )
     */
    public function getDetailsUserAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->getItem($user->getId());
        $serializer = $this->container->get('serializer');
        $itemSerializer = $serializer->serialize($user[0], 'json');
        return new Response($itemSerializer, 200);
    }

    /**
     * @Route(
     *     name="setAttributesUser",
     *     path="/api/core-users/setAttributesUser",
     *     methods={"POST"}
     * )
     */
    public function setAttributesUserAction(Request $request ,OAuth2 $oauth2)
    {
        $em = $this->getDoctrine()->getManager();
        $token = $this->$oauth2->getBearerToken();
        if ($request->get('original_user')) {
            $user = $em->getRepository(User::class)->find(intval($request->get('original_user')));
        } else {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        $accessToken = $em->getRepository(AccessToken::class)->findOneBy(array(
                'user' => $user,
                'token' => $token)
        );
        $content = json_decode($request->getContent());
        $attributes = array();
        $attributes['currencySymbol'] = $this->get('app.core.currency.service')->getCurrencyByUser($user->getId())['currencySymbol'];
        $attributes['access_token'] = $token;
        $attributes['expires_at'] = $content->expires_at;
        $attributes['refresh_token'] =  $content->refresh_token;
        $attributes['lang'] =  $content->lang;
        $attributes['organizationType'] =  $content->organizationType;
        $attributes['supplier'] =  $content->supplier;
        $attributes['organizationId'] =  $content->organizationId;
        $attributes['nomen_clature'] =  $content->nomen_clature;
        $attributes['selectedOrganizationTypeId'] =  $content->selectedOrganizationTypeId;
        $attributes['user_id'] = $user->getId();
        $accessToken->setAttributes($attributes);

        $em->persist($accessToken);
        $em->flush();

        return new Response(200);
    }

    /**
     * @Route(
     *     name="getAttributesUser",
     *     path="/api/core-users/getAttributesUser",
     *     methods={"GET"},
     * )
     */
    public function getAttributesUserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $token = $this->get('fos_oauth_server.server')->getBearerToken();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $accessToken = $em->getRepository(AccessToken::class)->findOneBy(array(
                'user' => $user,
                'token' => $token
            )
        );
        $attributes = $accessToken->getAttributes();

        /*$serializer = $this->container->get('serializer');
        $itemSerializer = $serializer->serialize(array('attributes' => $attributes, 'actions' => $actions), 'json');*/
        return new JsonResponse(array('attributes' => $attributes, 'actions' => $actions), 200);
    }

    /**
     * @Route("/api/core-users/enable-disable/{id}", name="api_core_users_enable_disable")
     * @Method({"POST"})
     */
    public function enableDisableAction(User $coreUser)
    {

        $coreUser->setEnabled(!$coreUser->isEnabled());
        $em = $this->getDoctrine()->getManager();
        $em->persist($coreUser);
        $em->flush();

        return new JsonResponse(array(
            'isEnabled' => $coreUser->isEnabled()
        ));
    }


    /**
     * @Route(
     *     name="get_swiched_user",
     *     path="/api/core-users/swichusers",
     *     methods={"GET"},
     *     defaults={
     *          "_api_resource_class"=CoreUser::class,
     *          "_api_operation_name"="get_swiched_user"
     *      }
     * )
     */
    public function swichusersAction(AuthorizationCheckerInterface $authorizationChecker,  TokenStorageInterface $tokenStorage, Request $request)
    {
        $token = $this->security->getToken();
        if ($token instanceof SwitchUserToken) {
            $swiched_user =  array(
                'user_id' => $this->getUser()->getId(),
                'email' => $this->getUser()->getEmail(),

            );
            return new JsonResponse($swiched_user);

        }


        return new JsonResponse(
            'Access denied',
            JsonResponse::HTTP_FORBIDDEN
        );
    }
    /**
     * @Route(
     *     name="logoutFromSwichedAccount",
     *     path="/api/core-users/logoutFromSwichedAccount",
     *     methods={"GET"},
     *     defaults={
     *          "_api_resource_class"=CoreUser::class,
     *          "_api_operation_name"="logoutFromSwichedAccount"
     *      }
     * )
     */
    public function logoutFromSwichedAccountAction(Request $request)
    {

        $swiched_user =  array(
            'user_id' => $this->getUser()->getId(),
            'email' => $this->getUser()->getEmail(),

        );
        return new JsonResponse($swiched_user);
    }
}