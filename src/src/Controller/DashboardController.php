<?php

namespace App\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Document\User;


class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(Request $request,DocumentManager $dm): Response
    {
        $userId = $request->getSession()->get('logged-in');//change to security-bundle / doctrine bundle docs down
        if(!$userId){
            return $this->redirect('/login');
        }

        $users = $dm->createQueryBuilder(User::class)
            ->sort('createdAt','-1')
            ->getQuery()
            ->execute();

        return $this->render('dashboard/index.html.twig', [
            'users'=>$users,
        ]);
    }
}
