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
        $form = $this->createForm(\App\Form\SubscribingType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $this->userRepo->save($user);

            return $this->redirectToRoute('app_sell_profile');
        }

        return $this->render('front/seller/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/account/seller", methods={"GET"})
     */
    public function profile(): Response
    {
        return $this->render('front/seller/profile.html.twig');
    }

}
