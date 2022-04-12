<?php


use Trismegiste\SymfoTools\Form\FingerprintType;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Validation;

class FingerprintTypeTest extends TypeTestCase
{

    protected function getExtensions()
    {
        return [new ValidatorExtension(Validation::createValidator())];
    }

    public function testSubmitEmpy()
    {
        $form = $this->factory->create(FingerprintType::class);

        $form->submit(null);

        $this->assertTrue($form->isSynchronized());
        $this->assertTrue($form->isValid());
    }

    public function testSubmitData()
    {
        $form = $this->factory->create(FingerprintType::class);

        $form->submit('1234567890abcdef');

        $this->assertTrue($form->isSynchronized());
        $this->assertTrue($form->isValid());
    }

}
