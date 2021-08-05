<?php

/*
 * Vesta
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Search form
 */
class SearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('city', TextType::class, ['attr' => ['placeholder' => 'City']])
                ->add('price_floor', NumberType::class, ['required' => false])
                ->add('price_ceil', NumberType::class, ['required' => false])
                ->add('search', SubmitType::class);
    }

}
