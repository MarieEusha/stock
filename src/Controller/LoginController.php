<?php

namespace App\Controller;

use App\Entity\User;
//use Symfony\Component\Security\Core\User\UserInterface;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginController extends AbstractController
{

    /**
     * @Route("/inscription",name="security_registration")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){

        $user = new User();

        //lie le form a la table user
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid(0)){

            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);

            //prepare le user a être sauvegarder en bdd
            $manager->persist($user);
            //sauvegarde le user en bdd
            $manager->flush();
        }

        return $this->render('login/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(UserRepository $repo)
    {
    
       

        return $this->render('login/login.html.twig');
    }


/**
 * @Route("/", name="home")
 */
    public function home(){
        return $this->redirectToRoute('article_list');
    }

    /**
     * @Route("/logout", name="logout")
     */

     public function logout(){
         
     }
}
