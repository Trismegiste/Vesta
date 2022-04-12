<?php

use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Validation;
use Trismegiste\SymfoTools\Form\TextChoiceType;
use Trismegiste\SymfoTools\Repository\YamlRepository;

class TextChoiceTypeTest extends TypeTestCase
{

    protected function getExtensions()
    {
        $repo = new YamlRepository(__DIR__ . '/../Repository/test_repo.yml');
        $widget = new TextChoiceType($repo);

        return [
            new PreloadedExtension([$widget], []),
            new ValidatorExtension(Validation::createValidator())
        ];
    }

    public function testSubmitData()
    {
        $form = $this->factory->create(TextChoiceType::class, null, ['category' => 'section9']);

        $form->submit('Motoko');

        $this->assertTrue($form->isSynchronized());
        $this->assertTrue($form->isValid());
    }

}
