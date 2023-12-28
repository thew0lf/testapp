<?php

namespace App\Controller;

use App\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ODM\MongoDB\DocumentManager;

use App\Form\Type\RegistrationType;
use App\Form\Model\Registration;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/registration', methods:['GET', 'HEAD'])]
    public function index(DocumentManager $dm): Response
    {
        $form = $this->createForm(RegistrationType::class, new Registration());

        return $this->render('registration/index.html.twig', array('form' => $form->createView()));
    }
    #[Route('/registration', methods:['POST'])]
    public function createAction(DocumentManager $dm,Request $request)
    {
        $form = $this->createForm(RegistrationType::class, new Registration());

        $form->handleRequest($request);

        //validate
        if ($form->isSubmitted() &&  $form->isValid()) {
            $registration = $form->getData();
            //store in db
            $registration->getUser()->setCreatedAt(new \DateTime('now'));
            $dm->persist($registration->getUser());
            $dm->flush();

            return $this->redirect('/login');
        }

        return $this->render('registration/index.html.twig', array('form' => $form->createView()));
    }
}
