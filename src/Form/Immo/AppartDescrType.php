<?php

/*
 * Vesta
 */

namespace App\Form\Immo;

use App\Entity\AppartDescr;
use App\Repository\YamlRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of Appartment
 */
class AppartDescrType extends AbstractType
{

    protected $choiceRepo;

    public function __construct(YamlRepository $realParameterRepo)
    {
        $this->choiceRepo = $realParameterRepo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('room', NumberType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('bedroom', NumberType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('floor', NumberType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('bathroom', NumberType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('toilet', NumberType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('shower', NumberType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('totalArea', NumberType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('carrezArea', NumberType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('livingRoomArea', NumberType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('ceilingHeight', NumberType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('lighting', ChoiceType::class, ['choices' => $this->choiceRepo->findAll('lighting'), 'placeholder' => '---'])
                ->add('scenery', ChoiceType::class, ['choices' => $this->choiceRepo->findAll('scenery'), 'placeholder' => '---'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => AppartDescr::class]);
    }

}
