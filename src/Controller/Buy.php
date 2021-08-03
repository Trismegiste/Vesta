<?php

/*
 * Vesta
 */

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\RealEstateRepo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ImmoSet;

/**
 * Section Achat de biens immobilier
 */
class Buy extends AbstractController
{

    protected $realestateRepo;

    public function __construct(RealEstateRepo $repository)
    {
        $this->realestateRepo = $repository;
    }

    /**
     * @Route("/search", methods={"GET"})
     */
    public function search(Request $request): Response
    {
        $form = $this->createForm(SearchType::class, null, [
            'action' => $this->generateUrl('app_buy_search'),
            'method' => 'GET',
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $criterion = $form->getData();
            $listing = $this->realestateRepo->search();

            return $this->render('front/listing.html.twig', ['result' => new ImmoSet($listing), 'city' => $criterion['city']]);
        }

        return $this->render('front/buyer/search.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/visit/{pk}", methods={"GET"}, requirements={"pk"="[\da-f]{24}"})
     */
    public function visit(string $pk): Response
    {
        $listing = $this->realestateRepo->search();
        return $this->render('front/visit.html.twig', ['immo' => $listing->current()]);
    }

    /**
     * @Route("/detail/{pk}", methods={"GET"}, requirements={"pk"="[\da-f]{24}"})
     */
    public function detail(string $pk): Response
    {
        $listing = $this->realestateRepo->search();
        return $this->render('front/detail.html.twig', ['immo' => $listing->current()]);
    }

}
