<?php

/*
 * Vesta
 */

namespace App\Form\Immo;

use App\Entity\Building;
use App\Repository\YamlRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form for the building
 */
class BuildingType extends AbstractType
{

    protected $choiceRepo;

    public function __construct(YamlRepository $realParameterRepo)
    {
        $this->choiceRepo = $realParameterRepo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('name', TextType::class, ['label' => 'Building name'])
                ->add('district', TextType::class)
                ->add('floor', NumberType::class, ['label' => 'Floor count', 'attr' => ['class' => 'pure-input-1-3']])
                ->add('heating', ChoiceType::class, ['choices' => $this->choiceRepo->findAll('heating'), 'placeholder' => '---'])
                ->add('coownership', ChoiceType::class, ['choices' => ['Oui' => true, 'Non' => false], 'expanded' => true])
                ->add('alotAmount', NumberType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('hotWater', ChoiceType::class, ['choices' => $this->choiceRepo->findAll('hotwater'), 'placeholder' => '---'])
                ->add('standing', ChoiceType::class, ['choices' => $this->choiceRepo->findAll('standing'), 'placeholder' => '---'])
                ->add('security', ChoiceType::class, ['choices' => $this->choiceRepo->findAll('security'), 'placeholder' => '---'])
                ->add('construction', ChoiceType::class, ['choices' => $this->choiceRepo->findAll('construction'), 'placeholder' => '---'])
                ->add('facelift', DateType::class, ['required' => false])
                ->add('informationFlag', ChoiceType::class, [
                    'choices' => $this->choiceRepo->findAll('informationFlag'),
                    'expanded' => true,
                    'multiple' => true
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Building::class]);
    }

}
