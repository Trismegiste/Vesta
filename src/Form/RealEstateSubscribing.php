<?php

/*
 * Vesta
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * A seller wants to create a new real estate
 */
class RealEstateSubscribing extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('email', EmailType::class)
                ->add('crypto', PasswordType::class)
                ->add('firstname', TextType::class)
                ->add('lastname', TextType::class)
                ->add('phone', TelType::class)
                ->add('professional', CheckboxType::class)
                ->add('address', TextType::class)
                ->add('postalcode', TextType::class)
                ->add('city', TextType::class)
                ->add('dweller', CheckboxType::class)
                ->add('identity', FileType::class)
                ->add('owner_act', FileType::class)
                ->add('subscribe', SubmitType::class);
    }

}
