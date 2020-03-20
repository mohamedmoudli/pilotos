<?php
/**
 * Created by PhpStorm.
 * User: abdallah.benhmiden
 * Date: 30/01/2019
 * Time: 14:35
 */

namespace App\Controller;

use App\Service\UserManager;
use OAuth2\OAuth2ServerException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Entity\User;
use OAuth2\OAuth2;

class SecurityController extends AbstractController
{
    private $userManager;
    private $encoderFactory;
    private $ioauth;
    private $aouthservice;
    private $retryTtl;

    public function __construct(UserManager $userManager, EncoderFactoryInterface $encoderFactory)
    {
        $this->userManager = $userManager;
        $this->encoderFactory = $encoderFactory;

    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("/login1", name="app_login")
     */
    public function login(Request $request,OAuth2 $oauth2): JsonResponse
    {
        if ($request->isMethod('POST')) {

            // $content = json_decode($request->getContent(),true);
            // $password = $request->request->get('password');
            $entityManager = $this->getDoctrine()->getManager();
            $res = $request->get("email");
            $user = $this->userManager->getUserByEmail($res);
            dump($res);
            dump($user);
            /* @var $user User */

            if ($user === null) {
                return new JsonResponse("Invalid username".$request->get("username"), 500);
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
     * @Route("api/register", name="app_register")
     */
    public function register()
    {
        return $this->render('security/register.html.twig');
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
                ->setFrom('benhmiden.abdallah@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    "le token pour reseter votre mot de passe : " . $url,
                    'text/html'
                );

            $mailer->send($message);

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
            return array_merge(
                json_decode(
                    $oauth2
                        ->grantAccessToken($request2)
                        ->getContent(), true
                ), array(
                    'expires_at' => (new \DateTime())->getTimestamp() + $this->getParameter('token_lifetime'),
                    'user_id' => $user->getId(),
                    'email' => $user->getEmail(),
                )
            );
        } catch (OAuth2ServerException $e) {
            return $e->getHttpResponse();
        }
    }

}
