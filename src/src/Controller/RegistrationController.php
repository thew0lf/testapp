<?php

namespace App\Controller;

use App\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ODM\MongoDB\DocumentManager;

use App\Form\Type\RegistrationType;
use App\Form\Model\Registration;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name:'app_registration')]
    public function index(Request $request, DocumentManager $dm, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $form = $this->createForm(RegistrationType::class, new Registration());
        $form->handleRequest($request);
        if ($form->isSubmitted() &&  $form->isValid()) {
            $registration = $form->getData();

            $registrationForm = $request->get('registration');
            $hashedPassword = $userPasswordHasher->hashPassword($registration->getUser(),$registrationForm['user']['password']);

            $registration->getUser()->setCreatedAt(new \DateTime('now'));
            $registration->getUser()->setRoles(['ROLE_ADMIN']);
            $registration->getUser()->setPassword($hashedPassword);

            $dm->persist($registration->getUser());
            $dm->flush();
            return $this->redirect('/dashboard');
        }

        return $this->render('registration/index.html.twig', array('form' => $form->createView()));
    }
}
