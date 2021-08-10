<?php

/*
 * Vesta
 */

namespace App\Form\Immo;

use App\Entity\Diagnostics;
use App\Repository\YamlRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * DiagnosticsType for Norms, Standards and legal Diagnostics
 */
class DiagnosticsType extends AbstractType
{

    protected $choiceRepo;

    public function __construct(YamlRepository $realParameterRepo)
    {
        $this->choiceRepo = $realParameterRepo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('houseStandardsFlag', ChoiceType::class, [
                    'choices' => $this->choiceRepo->findAll('houseStandardsFlag'),
                    'expanded' => true,
                    'multiple' => true
                ])
                ->add('diagnosticsFlag', ChoiceType::class, [
                    'choices' => $this->choiceRepo->findAll('diagnosticsFlag'),
                    'expanded' => true,
                    'multiple' => true
                ])
                ->add('energyPerformance', ChoiceType::class, [
                    'choices' => $this->choiceRepo->findAll('energyPerformance'),
                    'expanded' => true,
                    'multiple' => true
                ])
                ->add('energyUptake', NumberType::class, ['help' => 'KWh/m² par an'])
                ->add('energyUptakeReportDate', DateType::class)
                ->add('greenhouseGas', NumberType::class, ['help' => 'kg CO2/m² par an'])
                ->add('greenhouseGasReportDate', DateType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Diagnostics::class]);
    }

}
