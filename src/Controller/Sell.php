<?php

/*
 * Vesta
 */

namespace App\Controller;

use App\Form\RealEstateSubscribing;
use App\Repository\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Seller section controller
 */
class Sell extends AbstractController
{

    protected $userRepo;

    public function __construct(UserService $repo)
    {
        $this->userRepo = $repo;
    }

    /**
     * @Route("/sell", methods={"GET","POST"})
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(RealEstateSubscribing::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $user = $this->userRepo->createAndSave($data['email'], $data['crypto']);

            return $this->redirectToRoute('subscribing_ok');
        }

        return $this->render('front/seller/create.html.twig', ['form' => $form->createView()]);
    }

}
