<?php

/*
 * Vesta
 */

namespace App\Controller;

use App\Form\NewRealEstate;
use App\Form\SubscribingType;
use App\Repository\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Trismegiste\Toolbox\MongoDb\Repository;

/**
 * Seller section controller
 */
class Sell extends AbstractController
{

    protected $userRepo;
    protected $realRepo;

    public function __construct(UserService $repo, Repository $realRepo)
    {
        $this->userRepo = $repo;
        $this->realRepo = $realRepo;
    }

    /**
     * @Route("/sell", methods={"GET","POST"})
     */
    public function create(Request $request): Response
    {
        $form = $this->createFormBuilder()
                ->add('user', SubscribingType::class)
                ->add('realestate', NewRealEstate::class)
                ->add('subscribe', SubmitType::class)
                ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $creation = $form->getData();
            $this->userRepo->save($creation['user']);
            $this->realRepo->save($creation['realestate']);

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
