<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class DeveloperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, ['required' => false, 'constraints' => [
                new NotBlank([
                    'message' => 'Please enter an email.'
                ])
            ]])
            ->add('firstName', TextType::class, ['constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a first name',
                    ]),
                ],
            ])
            ->add('lastName', TextType::class, ['constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a last name',
                    ]),
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => true,
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'Developer' => 'ROLE_DEVELOPER'
                ],
                'label' => false                
            ])
            ->add('city', TextType::class, ['constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a city',
                    ]),
                ],
            ])
            ->add('phone', TextType::class, ['constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a phone number',
                    ]),
                ],
            ])
            ->add('street', TextType::class, ['constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a street name',
                    ]),
                ],
            ])
            ->add('postalCode', TextType::class, ['constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a postal code',
                    ]),
                ],
            ])
            ->add('country', TextType::class, ['constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a country',
                    ]),
                ],
            ])
            ->add('account', TextType::class, ['constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an account number',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, ['label' => 'Submit'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
