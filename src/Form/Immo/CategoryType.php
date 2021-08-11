<?php

/*
 * Vesta
 */

namespace App\Form\Immo;

use App\Entity\RealEstate;
use App\Repository\YamlRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * The category of a RealEstate
 */
class CategoryType extends AbstractType
{

    protected $typeChoice = [];

    public function __construct(YamlRepository $realParameterRepo)
    {
        $this->typeChoice = $realParameterRepo->findAll('type');
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('category', ChoiceType::class, ['choices' => $this->typeChoice])
                ->add('update', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RealEstate::class
        ]);
    }

}
