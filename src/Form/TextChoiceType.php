<?php

/*
 * symfo-tools
 */

namespace Trismegiste\SymfoTools\Form;

use Trismegiste\SymfoTools\Repository\FlatRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * TextChoiceType is a choice type linked to a yaml file
 */
class TextChoiceType extends AbstractType
{

    protected $repository;

    public function __construct(FlatRepository $repo)
    {
        $this->repository = $repo;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('category');

        $resolver->setDefault('choices', function (Options $opt) {
            return $this->repository->findAll($opt['category']);
        });
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

}
