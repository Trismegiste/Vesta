<?php

/*
 * Vesta
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\RealEstateSubscribing;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;
use Trismegiste\Toolbox\MongoDb\Repository;

/**
 * Seller section controller
 */
class Sell extends AbstractController
{

    protected $userRepo;
    protected $hasher;

    public function __construct(PasswordHasherFactoryInterface $h, Repository $userRepo)
    {
        $this->userRepo = $userRepo;
        $this->hasher = $h->getPasswordHasher(User::class);
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
            $user = new User($data['email'], $this->hasher->hash($data['crypto']));
            $this->userRepo->save($user);

            return $this->redirectToRoute('subscribing_ok');
        }

        return $this->render('front/seller/create.html.twig', ['form' => $form->createView()]);
    }

}
