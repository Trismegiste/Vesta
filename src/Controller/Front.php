<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Front extends AbstractController
{

    /**
     * @Route("/")
     */
    public function essai(): Response
    {
        return $this->render('front/index.html.twig');
    }

}
