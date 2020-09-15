<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Form\ArticleType;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

/**
 * @Route("/admin/new", name="article_create")
 * @Route("/admin/{id}/edit", name="article_edit")
 */

    public function form(Article $article = null,Request $request, ObjectManager $manager){

        if(!$article){
            $article = new Article();
        }

        $form = $this->createForm(ArticleType::class,$article);
        // $form = $this->createFormBuilder($article)
        //              ->add('label')
        //              ->add('price',TextType::class)
        //              ->add('ref',TextType::class)
        //              ->getForm();


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('article_list');
        }
        return $this->render('admin/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId()!==null
        ]);
    }

/**
 * @Route("admin/list", name="article_list")
 */
    public function list(ArticleRepository $repo){

        $articles =  $repo->findAll();

        return $this->render('admin/list.html.twig', [
            'articles' => $articles
        ]);
    }
}
