<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{

    public function testGetRegistrationFormValid(): void
    {
        $client = static::createClient();
        $client->request('GET', '/registration');
        $this->assertResponseStatusCodeSame(200, $client->getResponse()->getStatusCode());

    }

    public function testRegistrationFormValid(): void
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/registration');
        $form = $crawler->filter('main form')->form([
        'registration[user][name]' => 'Test Case User',
        'registration[user][email]' => uniqid('et-').'@test.org',//et- for removal [soft-delete / delete]
        'registration[user][password]' => 'MyPass!',
        'registration[terms]' => true,
            ]);
       $client->submit($form);
       $this->assertResponseStatusCodeSame(302);
       $this->assertResponseRedirects('/dashboard');
   }
   //add additional test cases like testLoginForm


}