<?php

/*
 * Vesta
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Seller section controller
 */
class Sell extends AbstractController
{

    /**
     * @Route("/sell", methods={"GET","POST"})
     */
    public function create(): Response
    {
        $form = $this->createFormBuilder()
                ->add('email', TextType::class)
                ->add('password', TextType::class)
                ->add('Envoi', SubmitType::class)
                ->getForm();

        return $this->render('front/seller/create.html.twig', ['form' => $form->createView()]);
    }

}
