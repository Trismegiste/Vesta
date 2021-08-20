<?php

namespace App\Controller;

use App\Form\SubscribingType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class Security extends AbstractController
{

    /**
     * @Route("/account/login", name="app_login", methods={"GET", "POST"})
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(\App\Form\LoginType::class, ['username' => $lastUsername]);
        $form->addError(new \Symfony\Component\Form\FormError($error));

        return $this->render('front/login.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout()
    {
        // Don't forget to activate logout in security.yaml
        throw new Exception('Bad config');
    }

    /**
     * @Route("/subscribe", methods={"GET", "POST"})
     */
    public function subscribe(Request $request): Response
    {
        $form = $this->createFormBuilder()
                ->add('user', SubscribingType::class)
                ->add('subscribe', SubmitType::class)
                ->getForm();

        return $this->render('front/subscribe.html.twig', ['form' => $form->createView()]);
    }

}
