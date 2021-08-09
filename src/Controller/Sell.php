<?php

/*
 * Vesta
 */

namespace App\Controller;

use App\Form\Immo\BuildingType;
use App\Form\NewRealEstate;
use App\Form\SubscribingType;
use App\Repository\RealEstateRepo;
use App\Repository\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Seller section controller
 */
class Sell extends AbstractController
{

    protected $userRepo;
    protected $realRepo;

    public function __construct(UserService $repo, RealEstateRepo $realRepo)
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
            $creation['realestate']->setFkOwner($creation['user']->getPk());
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
        $pkUser = $this->getUser()->getPk();
        return $this->render('front/seller/profile.html.twig', ['list' => $this->realRepo->findByOwner($pkUser)]);
    }

    /**
     * @Route("/realestate/edit/{pk}", methods={"GET","POST"}, requirements={"pk"="[\da-f]{24}"})
     */
    public function edit(string $pk): Response
    {
        $realEstate = $this->realRepo->findByPk($pk);
        $form = $this->createFormBuilder()
                ->add('building', BuildingType::class, ['property_path' => 'building'])
                ->add('update', SubmitType::class)
                ->setData($realEstate)
                ->getForm();

        return $this->render('front/seller/realestate_edit.html.twig', ['immo' => $realEstate, 'form' => $form->createView()]);
    }

}
