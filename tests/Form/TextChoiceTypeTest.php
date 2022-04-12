<?php

use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Validation;
use Trismegiste\SymfoTools\Form\TextChoiceType;

class TextChoiceTypeTest extends TypeTestCase
{

    protected function getExtensions()
    {
        return [new ValidatorExtension(Validation::createValidator())];
    }

    public function testSubmitData()
    {
        $form = $this->factory->create(TextChoiceType::class, ['category' => 'section9']);

        $form->submit('Motoko');

        $this->assertTrue($form->isSynchronized());
        $this->assertTrue($form->isValid());
    }

}
