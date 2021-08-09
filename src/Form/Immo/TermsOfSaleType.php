<?php

/*
 * Vesta
 */

namespace App\Form\Immo;

use App\Entity\TermsOfSale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form pour les Conditions de vente
 */
class TermsOfSaleType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('mandataryName', TextType::class)
                ->add('mandateNumber', TextType::class)
                ->add('mandateStart', DateType::class)
                ->add('mandateEnd', DateType::class)
                ->add('availabilityDate', DateType::class)
                ->add('availableRent', ChoiceType::class, ['choices' => ['Libre' => 'free', 'Loué' => 'rent'], 'expanded' => true])
                ->add('lifeAnnuity', ChoiceType::class, ['choices' => ['Non' => false, 'Oui' => true], 'expanded' => true])
                ->add('newProgram', ChoiceType::class, ['choices' => ['Non' => false, 'Oui' => true], 'expanded' => true])
                ->add('investmentProduct', ChoiceType::class, ['choices' => ['Non' => false, 'Oui' => true], 'expanded' => true])
                ->add('propertyTax', MoneyType::class, ['attr' => ['class' => 'pure-input-1-2']])
                ->add('housingTax', MoneyType::class, ['attr' => ['class' => 'pure-input-1-2']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => TermsOfSale::class]);
    }

}
