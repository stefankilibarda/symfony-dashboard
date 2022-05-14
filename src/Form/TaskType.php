<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\UserClient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('client', EntityType::class, [
            //     'class' => Client::class,
            //     'choice_label' => 'clientName',
            //     'label' => false                
            // ])
            // ->add('client', TextareaType::class, [
            //     // 'attr' => ['class' => 'tinymce'],
            //     'label' => false                

            // ])
            // ->add('submit', SubmitType::class, ['label' => 'Add task']);

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserClient::class,
        ]);
    }
}
