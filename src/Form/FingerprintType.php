<?php

/*
 * symfo-tools
 */

namespace Trismegiste\SymfoTools\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * Capture the web browser fingerprint
 */
class FingerprintType extends AbstractType
{

    public function getParent()
    {
        return HiddenType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('required', false);
        $resolver->setDefault('constraints', [new Regex('/[a-f0-9]+/')]);
    }

}
