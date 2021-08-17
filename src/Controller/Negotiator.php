<?php

/*
 * Vesta
 */

namespace App\Controller;

use App\Entity\ImmoSet;
use App\Repository\RealEstateRepo;
use MongoDB\BSON\Regex;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Workflow for Real Estate
 */
class Negotiator extends AbstractController
{

    protected $realestateRepo;

    public function __construct(RealEstateRepo $repository)
    {
        $this->realestateRepo = $repository;
    }

    /**
     * List all real estate without a negotiator
     * 
     * @Route("/workflow/unaffected", methods={"GET"})
     * @return Response
     */
    public function listUnaffectedImmo(): Response
    {
        $negotiator = $this->getUser();
        $listing = $this->realestateRepo->search([
            'city' => new Regex('^' . $negotiator->getCity() . '$', 'i'),
            'negotiator' => null
        ]);

        return $this->render('/negotiator/listing.html.twig', ['result' => new ImmoSet($listing), 'city' => $negotiator->getCity()]);
    }

    /**
     * List all real estates affected to the current negotiator
     * 
     * @Route("/workflow/affected", methods={"GET"})
     * @return Response
     */
    public function listAffectedImmo(): Response
    {
        $negotiator = $this->getUser();
        $listing = $this->realestateRepo->search([
            'negotiator' => $negotiator->getPk()
        ]);

        return $this->render('/negotiator/listing.html.twig', ['result' => new ImmoSet($listing), 'city' => '']);
    }

}
