<?php

/*
 * Vesta
 */

namespace App\Form\Immo;

use App\Repository\YamlRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Form the building
 */
class BuildingType extends AbstractType
{

    protected $hotWaterChoice = [];

    public function __construct(YamlRepository $realParameterRepo)
    {
        $this->hotWaterChoice = $realParameterRepo->findAll('hotwater');
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('name', TextType::class)
                ->add('district', TextType::class)
                ->add('floor', NumberType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('heating', ChoiceType::class, ['choices' => $this->hotWaterChoice]);
    }

}
