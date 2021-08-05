<?php

/*
 * Vesta
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Creation of a new RealEstate
 */
class NewRealEstate extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('real_address', TextType::class)
                ->add('postalcode', TextType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('city', TextType::class, ['attr' => ['class' => 'pure-input-2-3']])
        /*      ->add('dweller', CheckboxType::class, ['required' => false])
          ->add('owner_act', FileType::class) */
        //      ->add('subscribe', SubmitType::class);
        ;
    }

}
