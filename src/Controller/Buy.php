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
     * @Route("/detail", methods={"GET"})
     */
    public function detail(): Response
    {
        $listing = $this->realestateRepo->search();
        return $this->render('front/detail.html.twig', ['immo' => $listing->current()]);
    }

}
