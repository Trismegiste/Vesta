<?php

/*
 * Vesta
 */

namespace App\Controller;

use App\Repository\Storage;
use MongoDB\BSON\ObjectId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller for pictures
 */
class Picture extends AbstractController
{

    protected Storage $repository;

    public function __construct(Storage $repo)
    {
        $this->repository = $repo;
    }

    /**
     * @Route("/picture/{pk}", methods={"GET"}, requirements={"pk"="[\da-f]{24}"})
     */
    public function read(string $pk, \Symfony\Component\HttpFoundation\Request $request): Response
    {
        $response = $this->repository->get(new ObjectId($pk));
        $response->setPublic();

        if ($response->isNotModified($request)) {
            // return the 304 Response immediately
            return $response;
        }

        return $response;
    }

}
