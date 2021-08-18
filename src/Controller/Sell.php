<?php

/*
 * Vesta
 */

namespace App\Controller;

use App\Form\Immo\AppartDescrType;
use App\Form\Immo\BuildingType;
use App\Form\Immo\CategoryType;
use App\Form\Immo\DiagnosticsType;
use App\Form\Immo\TermsOfSaleType;
use App\Form\NewRealEstateType;
use App\Form\SubscribingType;
use App\Repository\RealEstateRepo;
use App\Repository\UserService;
use App\Security\FormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
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
            'type' => AppartDescrType::class,
            'property' => 'appartDescr',
            'title' => 'DESCRIPTION'
        ],
        2 => [
            'type' => DiagnosticsType::class,
            'property' => 'diagnostics',
            'title' => 'DESCRIPTION'
        ],
        3 => [
            'type' => BuildingType::class,
            'property' => 'building',
            'title' => 'BUILDING INFORMATION'
        ],
        4 => [
            'type' => TermsOfSaleType::class,
            'property' => 'termsOfSale',
            'title' => 'TERMS OF SALE'
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
    public function create(Request $request,
            FormAuthenticator $loginAuthenticator,
            UserAuthenticatorInterface $auth): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_sell_sellinglist');
        }

        $form = $this->createFormBuilder()
                ->add('user', SubscribingType::class)
                ->add('realestate', NewRealEstateType::class)
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
            $creation['realestate']->setOwnerFk($creation['user']);
            $this->realRepo->save($creation['realestate']);

            // AUTHENTICATE ON THE FLY
            $auth->authenticateUser($newUser, $loginAuthenticator, $request);

            return $this->redirectToRoute('app_sell_sellinglist');
        }

        return $this->render('front/seller/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/selling", methods={"GET"})
     */
    public function sellingList(): Response
    {
        $pkUser = $this->getUser()->getPk();

        return $this->render('/negotiator/planning.html.twig');

        //   return $this->render('front/seller/listing.html.twig', ['list' => $this->realRepo->findByOwner($pkUser)]);
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
