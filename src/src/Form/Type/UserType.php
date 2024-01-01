<?php

namespace App\Form\Type;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Document\User;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, ['required'=>true,
                    'label' => 'Name',
                    'attr' => [
                        'placeholder' => 'Name',
                        'class' =>'form-control'
                    ],
                    'row_attr' => [
                        'class' => 'form-floating',
                    ],'constraints'=> [new Length(['min'=>3])]])
                ->add('email', EmailType::class,['required'=>true,
                        'label' => 'Email',
                        'attr' => [
                            'placeholder' => 'Email',
                            'class' =>'form-control'
                        ],
                        'row_attr' => [
                            'class' => 'form-floating',
                        ],
                    'constraints'=> [new Email()]]
                    )//make unique doctrine mongodb docs are down
                ->add('password', PasswordType::class, ['required'=>true,
                'label' => 'Password',
                'attr' => [
                    'placeholder' => 'Password',
                    'class' =>'form-control'
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],'constraints'=> [new Length(['min'=>3])]]);//change to passwordstrength and common passwords

    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'constraints'=> [
                new UniqueEntity(['fields'=>['email'],
                                    'message'=>'The current email has an account',
                                    'service'=>'doctrine_odm.mongodb.unique',
                                    'entityClass'=>User::class])
            ],
            'data_class' => User::class,
        ));
    }
}