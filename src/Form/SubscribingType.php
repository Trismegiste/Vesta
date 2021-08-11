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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
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
                ->add('email', EmailType::class, ['property_path' => 'username', 'attr' => ['class' => 'pure-input-2-3']])
                ->add('crypto', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'invalid_message' => 'The password fields must match.',
                    'options' => ['attr' => ['class' => 'password-field']],
                    'required' => true,
                    'first_options' => ['label' => 'Password'],
                    'second_options' => ['label' => 'Repeat Password'],
                    'mapped' => false
                ])
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
                $user = $this->repo->create($form->get('email')->getData());

                return $user;
            }
        ]);
    }

}
