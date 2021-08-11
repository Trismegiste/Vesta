<?php

/*
 * Vesta
 */

namespace App\Controller;

use App\Form\Immo\AppartDescrType;
use App\Form\Immo\BuildingType;
use App\Form\Immo\DiagnosticsType;
use App\Form\Immo\TermsOfSaleType;
use App\Form\NewRealEstate;
use App\Form\SubscribingType;
use App\Repository\RealEstateRepo;
use App\Repository\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatableMessage;

/**
 * Seller section controller
 */
class Sell extends AbstractController
{

    protected $userRepo;
    protected $realRepo;
    protected $realEstateStep = [
        1 => [
            'type' => BuildingType::class,
            'property' => 'building',
            'title' => 'BUILDING INFORMATION'
        ],
        2 => [
            'type' => TermsOfSaleType::class,
            'property' => 'termsOfSale',
            'title' => 'TERMS OF SALE'
        ],
        3 => [
            'type' => DiagnosticsType::class,
            'property' => 'diagnostics',
            'title' => 'DESCRIPTION'
        ],
        4 => [
            'type' => AppartDescrType::class,
            'property' => 'appartDescr',
            'title' => 'DESCRIPTION'
        ]
    ];

    public function __construct(UserService $repo, RealEstateRepo $realRepo)
    {
        $this->userRepo = $repo;
        $this->realRepo = $realRepo;
    }

    /**
     * @Route("/sell", methods={"GET","POST"})
     */
    public function create(Request $request): Response
    {
        $form = $this->createFormBuilder()
                ->add('user', SubscribingType::class)
                ->add('realestate', NewRealEstate::class)
                ->add('subscribe', SubmitType::class)
                ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $creation = $form->getData();
            // USER
            $newUser = $creation['user'];
            $this->userRepo->changePassword($newUser, $form->get('user')->get('crypto')->getData());
            $this->userRepo->save($newUser);
            // REAL ESTATE
            $creation['realestate']->setFkOwner($creation['user']->getPk());
            $this->realRepo->save($creation['realestate']);

            return $this->redirectToRoute('app_sell_profile');
        }

        return $this->render('front/seller/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/account/seller", methods={"GET"})
     */
    public function profile(): Response
    {
        $pkUser = $this->getUser()->getPk();
        return $this->render('front/seller/profile.html.twig', ['list' => $this->realRepo->findByOwner($pkUser)]);
    }

    /**
     * @Route("/realestate/edit/{pk}/step/{step}", methods={"GET","POST"}, requirements={"pk"="[\da-f]{24}", "step"="\d+"})
     */
    public function editRealEstateStep(string $pk, int $step, Request $request): Response
    {
        $paramStep = $this->realEstateStep[$step];

        $realEstate = $this->realRepo->findByPk($pk);
        $form = $this->createFormBuilder()
                ->add('step', $paramStep['type'], ['property_path' => $paramStep['property']])
                ->add('update', SubmitType::class)
                ->setData($realEstate)
                ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $obj = $form->getData();
            $this->realRepo->save($obj);

            $route = (array_key_exists($step + 1, $this->realEstateStep)) ?
                    $this->generateUrl('app_sell_editrealestatestep', ['pk' => $pk, 'step' => $step + 1]) :
                    $this->generateUrl('app_sell_profile');

            return $this->redirect($route);
        }

        return $this->render('front/seller/realestate_edit_step.html.twig', [
                    'immo' => $realEstate,
                    'step' => $step,
                    'form' => $form->createView(),
                    'title' => new TranslatableMessage($paramStep['title'])
        ]);
    }

}
