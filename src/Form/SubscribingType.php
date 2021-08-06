<?php

/*
 * Vesta
 */

namespace App\Form;

use App\Entity\User;
use App\Repository\UserService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of SubscribingType
 *
 * @author flo
 */
class SubscribingType extends AbstractType
{

    protected $repo;

    public function __construct(UserService $repo)
    {
        $this->repo = $repo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('email', EmailType::class, ['attr' => ['class' => 'pure-input-2-3']])
                ->add('crypto', PasswordType::class, ['attr' => ['class' => 'pure-input-1-2']])
                ->add('crypto2', PasswordType::class, ['attr' => ['class' => 'pure-input-1-2']])
                ->add('firstname', TextType::class)
                ->add('lastname', TextType::class)
                ->add('phone', TelType::class, ['attr' => ['class' => 'pure-input-1-2']])
                ->add('professional', CheckboxType::class, ['required' => false]);
          //      ->add('identity', FileType::class, ['required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'empty_data' => function (FormInterface $form) {
                $user = $this->repo->create($form->get('email')->getData(), $form->get('crypto')->getData());
                $form->remove('email');
                $form->remove('crypto');
                $form->remove('crypto2');

                return $user;
            }
        ]);
    }

}
