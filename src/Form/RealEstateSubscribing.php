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
                ->add('email', EmailType::class, ['attr' => ['class' => 'pure-input-2-3']])
                ->add('crypto', PasswordType::class, ['attr' => ['class' => 'pure-input-1-2']])
                ->add('crypto2', PasswordType::class, ['attr' => ['class' => 'pure-input-1-2']])
                ->add('firstname', TextType::class)
                ->add('lastname', TextType::class)
                ->add('phone', TelType::class, ['attr' => ['class' => 'pure-input-1-2']])
                ->add('professional', CheckboxType::class)
                ->add('real_address', TextType::class)
                ->add('postalcode', TextType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('city', TextType::class, ['attr' => ['class' => 'pure-input-2-3']])
                ->add('dweller', CheckboxType::class)
                ->add('identity', FileType::class)
                ->add('owner_act', FileType::class)
                ->add('subscribe', SubmitType::class);
    }

}
