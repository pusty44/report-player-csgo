<?php
/**
 * Created by PhpStorm.
 * User: pusty
 * Date: 05.08.2018
 * Time: 15:45
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Service\SecurityService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\UserType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $securityService = $this->get(SecurityService::class);
        $login = $securityService->login($authenticationUtils);
        return $this->render('security/login.html.twig', array(
            'last_username' => $login['lastUsername'],
            'error'         => $login['error'],
            'domain'        => $this->getParameter('domain')
        ));
    }

    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setIsActive(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('login');
        }

        return $this->render(
            'security/register.html.twig',
            array(
                'form'          => $form->createView(),
                'domain'        => $this->getParameter('domain'))
        );
    }

    /**
     * @Route("/password-recovery", name="password_recovery")
     */
    public function recoveryPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setIsActive(true);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('login');
        }

        return $this->render(
            'security/password-recovery.html.twig',
            array(
                'form'          => $form->createView(),
                'domain'        => $this->getParameter('domain')
            )
        );
    }
}