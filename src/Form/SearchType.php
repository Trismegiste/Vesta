<?php

/*
 * Vesta
 */

namespace App\Form;

use App\Repository\YamlRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Search form
 */
class SearchType extends AbstractType
{

    protected $typeChoice = [];

    public function __construct(YamlRepository $realParameterRepo)
    {
        $this->typeChoice = $realParameterRepo->findAll('type');
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('city', TextType::class, ['attr' => ['placeholder' => 'City']])
                ->add('price_floor', NumberType::class, ['required' => false])
                ->add('price_ceil', NumberType::class, ['required' => false])
                ->add('type', ChoiceType::class, ['choices' => $this->typeChoice])
                ->add('search', SubmitType::class, ['label' => 'BUTTON SEARCH']);
    }

}
