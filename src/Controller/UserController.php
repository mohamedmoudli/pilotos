<?php

namespace App\Controller;


use App\Entity\AccessToken;
use App\Entity\User;
use App\Service\AouthService;
use App\Service\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Controller\RegistrationController;
use FOS\UserBundle\Controller\ResettingController;
use FOS\UserBundle\Mailer\MailerInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Util\TokenGeneratorInterface;
use OAuth2\IOAuth2;
use OAuth2\OAuth2;
use OAuth2\OAuth2ServerException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Json;


class UserController extends AbstractController
{
    private $userManager;
    private $encoderFactory;
    private $ioauth;
    private $aouthservice;
    private $retryTtl;
    private $valueToCheck;

    public function __construct(UserManager $userManager, EncoderFactoryInterface $encoderFactory)
    {
        $this->userManager = $userManager;
        $this->encoderFactory = $encoderFactory;

    }

    /**
     * @Route("/my_login", name="app_login2")
     */
    public function login(Request $request,OAuth2 $oauth2): JsonResponse
    {
        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();
            $res = $request->get("email");
            $password = $request->get('password');
            $user = $this->userManager->getUserByEmail($res);
            $encoder = $this->encoderFactory->getEncoder($user);
            $bool = $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());

            if (!$user instanceof User || !$bool) {
                return new JsonResponse(['message' => 'Invalid credentials'], 500);
            }

            if (!$user->isEnabled()) {
                return new JsonResponse(['message' => 'User account is disabled.'], 500);
            }

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

    }






    /**
     * @Route("/my_register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        // success
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
     * @Route("/check-email-to-reset", name="check_email_to_reset")
     */
    public function checkEmailToResetAction( \Swift_Mailer $mailer, Request $request , UserManagerInterface $userManager , TokenGeneratorInterface $tokenGenerator)
    {
        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();
            $email = $request->request->get('email');
            $user = $this->userManager->getUserByEmail($email);
            if (!$user instanceof User) {
                return new JsonResponse(['isValid' => false], 200);
            }

            /** @var $tokenGenerator TokenGeneratorInterface */
            $token = $tokenGenerator->generateToken();


            try {
                $user->setConfirmationToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return new JsonResponse('false', 500);
            }
            dump('ffffffff');
            $data = "<a href='" . $this->getParameter("front_url") . "session/reset/" .
                $user->getConfirmationToken() . "'>Reset</a>";



            $message = (new \Swift_Message('chek email to reset '))
                ->setFrom('mohamedmouldi95@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    "le token pour reseter votre mot de passe : " . $data,
                    'text/html'
                );
            $mailer->send($message);
            $this->addFlash('notice', 'Mail envoyé');
            $user->setPasswordRequestedAt(new \DateTime());
            $userManager->updateUser($user);
            return  new JsonResponse('true',200);

        }
        return new JsonResponse('false',500);

    }



    /**
     * @Route("/reset_password/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request,string $token, UserPasswordEncoderInterface $passwordEncoder)
    {


        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();
            /* @var $user User */
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
            $user = $this->userManager->getUserByEmail($email);
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
             $mailer->send($message);



            $this->addFlash('notice', 'Mail envoyé');
            return  new JsonResponse('true',200);
        }

        return new JsonResponse('false',500);
    }

    /**
     * @Route("/activate", name="activate_user")
     */
    public function activateAction(Request $request , UserManagerInterface $userManager ,TokenGeneratorInterface  $tokenGenerator )
    {

        $token = $request->get('token');

        $entityManager = $this->getDoctrine()->getManager();
        $user = $userManager->findUserByConfirmationToken($token);
        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with "confirmation token" does not exist for value "%s"', $token));
        }

        /** @var $user User */
        $token1 = $tokenGenerator->generateToken();
        $user->setConfirmationToken($token1);
        $entityManager->flush();
        $user->setEnabled(true);
        $userManager->updateUser($user);

        return new Response('true', 200);
    }


    /**
     * @Route("/core-users/check-unique-by-email/{email}",
     *     name="core_users_check_unique_email",
     *     methods={"GET"},
     *     requirements={
     *          "email"=".+"
     *      }
     * )
     */
    public function checkUniqueEmailAction($email)
    {
        dump($email);
        $em = $this->getDoctrine()->getManager();
        $coreUser = $em->getRepository(User::class)->findOneBy(array(
            'email' => $email
        ));
        dump($coreUser);

        return new JsonResponse(array(
            'isUnique' => is_null($coreUser)
        ));
    }

    /**
     * @Route(
     *     name="verify-currentPassword",
     *     path="/core-users/verify-currentPassword/{id}",
     *     methods={"POST"},
     * )
     */
    public function verifyCurrentPassword(User $user, Request $request)
    {
        try {
            $password = $request->get('password');
            $encoder = $this->encoderFactory->getEncoder($user);

            $bool = $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());
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
     *     methods={"GET"}
     * )
     */
    public function clearTokenAction( $id )
    {
        $em = $this->getDoctrine()->getManager();
        $accessTokens = $em->getRepository(AccessToken::class)->findBy(array('user' => $id));
        if(count($accessTokens)){
            foreach ($accessTokens as $accessToken){
                $em->remove($accessToken);
                $em->flush();
            }
            return new JsonResponse('success');
        }else{
            return new JsonResponse('no user found');
        }

    }



    /**
     * @Route("/core-users/enable-disable/{id}", name="api_core_users_enable_disable")
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
}