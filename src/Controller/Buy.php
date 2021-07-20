<?php

/*
 * Vesta
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of Buy
 *
 * @author flo
 */
class Buy extends AbstractController
{

    /**
     * @Route("/listing", methods={"GET"})
     */
    public function listing(): Response
    {
        $listing = ['e',1];
        return $this->render('front/listing.html.twig', ['result' => $listing]);
    }

}
