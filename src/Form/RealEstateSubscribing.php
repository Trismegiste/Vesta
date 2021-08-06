<?php

/*
 * Vesta
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * A seller wants to create a new real estate
 */
class RealEstateSubscribing extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('user', SubscribingType::class)
                ->add('realestate', NewRealEstate::class)
                ->add('subscribe', SubmitType::class);
    }

}
