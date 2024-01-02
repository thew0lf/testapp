<?php

namespace App\Tests\Form\Type;

use App\Document\User;
use App\Form\Type\RegistrationType;
use App\Form\Model\Registration;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Test\TypeTestCase;

class PasswordTypeTest extends TypeTestCase
{
    public function testSubmitValidData():void
    {

        $password = "my_pass";
        $user = new User();
        $user->setPassword($password);
        $form = $this->factory->create(PasswordType::class, $user);
        $form->submit(['password' => [
            'first' => 'bar',
            'second' => 'bar',
        ]]);
        $this->assertEquals($password, $user->getPassword());

    }
}
