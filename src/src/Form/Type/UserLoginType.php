<?php

namespace App\Form\Type;

use App\Document\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class UserLoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', EmailType::class,['required'=>true,
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
            ->add('password', TextType::class, ['required'=>true,
                'label' => 'Password',
                'attr' => [
                    'placeholder' => 'Password',
                    'class' =>'form-control'
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],'constraints'=> [new Length(['min'=>3])]]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}