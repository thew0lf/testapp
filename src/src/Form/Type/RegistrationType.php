<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        /** Create a form out of two Types */
        $builder->add('user', UserType::class)
                ->add('terms', CheckboxType::class, [
                    'property_path' => 'termsAccepted','label_attr' => [
                    'class' => 'checkbox-inline checkbox-switch',
                ]]);
    }
}