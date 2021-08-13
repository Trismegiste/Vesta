<?php

/*
 * Vesta
 */

namespace App\Form;

use App\Entity\RealEstate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Creation of a new RealEstate
 */
class NewRealEstateType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('address', TextType::class)
                ->add('postalcode', TextType::class, ['attr' => ['class' => 'pure-input-1-3']])
                ->add('city', TextType::class, ['attr' => ['class' => 'pure-input-2-3']])
                ->add('latitude', HiddenType::class, ['empty_data' => 0])
                ->add('longitude', HiddenType::class, ['empty_data' => 0])
                ->add('dweller', CheckboxType::class, ['required' => false]);
        // ->add('owner_act', FileType::class, ['required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RealEstate::class,
            'constraints' => [
                new Callback(['callback' => function (RealEstate $obj, ExecutionContextInterface $context) {
                        if (!$obj->isGeoValid()) {
                            $context->buildViolation('Invalid Address')
                                    ->atPath('address')
                                    ->addViolation();
                        }
                    }])
            ]
        ]);
    }

}
