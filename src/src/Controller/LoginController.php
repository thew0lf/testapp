<?php

namespace App\Controller;

use App\Form\Model\Login;
use App\Form\Type\LoginType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Document\User;

class LoginController extends AbstractController
{
    #[Route('/login', methods:['GET','HEAD'])]
    public function index(): Response
    {
        $form = $this->createForm(LoginType::class, new Login());
        return $this->render('login/index.html.twig', array('form' => $form->createView()));
    }

    #[Route('/login', methods:['POST'])]
    public function login(DocumentManager $dm,Request $request)
    {
        $form = $this->createForm(LoginType::class, new Login());

        $form->handleRequest($request);

        //validate
        if ($form->isSubmitted() &&  $form->isValid()) {
            $login = $form->getData();
            $user = $dm->getRepository(User::class)->findOneBy(
                ['email'=> $login->getUser()->getEmail(),'password'=> $login->getUser()->getPassword()]);

            if($user){
                $request->getSession()->set('logged-in',$user->getId());//change to security-bundle / doctrine bundle docs down
                return $this->redirect('/dashboard');
            }

            return $this->render('login/index.html.twig', array('form' => $form->createView()));
        }
    }
    #[Route('/logout', methods:['GET','POST','HEAD'])]
    public function logout(DocumentManager $dm,Request $request)
    {
        $request->getSession()->set('logged-in',null);//change to security-bundle / doctrine bundle docs down
        return $this->redirect('/dashboard');
    }
}
