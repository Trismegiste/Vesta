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
            $listing = $this->realestateRepo->search(['currentState.photoshoot' => true, 'category' => ['$ne' => null]]);

            return $this->render('front/buyer/listing.html.twig', ['result' => new ImmoSet($listing), 'city' => $criterion['city']]);
        }

        return $this->render('front/buyer/search.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/visit/{pk}", methods={"GET"}, requirements={"pk"="[\da-f]{24}"})
     */
    public function visit(string $pk): Response
    {
        $immo = $this->realestateRepo->findByPk($pk);
        return $this->render('front/buyer/visit.html.twig', ['immo' => $immo]);
    }

    /**
     * @Route("/detail/{pk}", methods={"GET"}, requirements={"pk"="[\da-f]{24}"})
     */
    public function detail(string $pk): Response
    {
        $immo = $this->realestateRepo->findByPk($pk);
        return $this->render('front/buyer/detail.html.twig', ['immo' => $immo]);
    }

}
