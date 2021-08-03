<?php

/*
 * Vesta
 */

namespace App\Controller;

use App\Form\RealEstateSubscribing;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function create(Request $request): Response
    {
        $form = $this->createForm(RealEstateSubscribing::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $subscribingData = $form->getData();
            var_dump($subscribingData);

            return $this->redirectToRoute('subscribing_ok');
        }

        return $this->render('front/seller/create.html.twig', ['form' => $form->createView()]);
    }

}
