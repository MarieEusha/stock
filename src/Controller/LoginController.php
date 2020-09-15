<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(UserRepository $repo)
    {
    
        $users = $repo->findAll();

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'users' => $users
        ]);
    }


/**
 * @Route("/", name="home")
 */
    public function home(){
        return $this->render('login/home.html.twig');
    }
}
