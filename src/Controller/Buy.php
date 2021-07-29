<?php

/*
 * Vesta
 */

namespace App\Controller;

use App\Entity\ImmoSet;
use App\Entity\RealEstate;
use App\Repository\RealEstateRepo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/listing", methods={"GET"})
     */
    public function listing(): Response
    {
        $listing = $this->realestateRepo->search();

        return $this->render('front/listing.html.twig', ['result' => new ImmoSet($listing)]);
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
