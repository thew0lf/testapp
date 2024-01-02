<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** Create a form out of two Types */
        $builder->add('user', UserLoginType::class)
//            ->add('rememberMe', CheckboxType::class, ['property_path' => 'rememberMe','label_attr' => [
//                'class' => 'checkbox-inline checkbox-switch',
//            ]])
        ;
    }
}