<?php

/*
 * Vesta
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Seller section controller
 */
class Sell extends AbstractController
{

    /**
     * @Route("/sell", methods={"GET"})
     */
    public function create(): Response
    {
        return new Response('azazaz');
    }

}
