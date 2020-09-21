<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Storage;
use App\Entity\Stored;
use App\Repository\ArticleRepository;
use App\Repository\StorageRepository;
use App\Repository\StoredRepository;
use App\Form\ArticleType;
use App\Form\StoredType;

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
 * @Route("/admin/{ref}/edit", name="article_edit")
 */

    public function form(Article $article = null,Request $request, ObjectManager $manager){

        if(!$article){
            $article = new Article();
        }
        
        $stored = new Stored();

        $formArticle = $this->createForm(ArticleType::class,$article);

        $formArticle->handleRequest($request);

        if($formArticle->isSubmitted() && $formArticle->isValid() ){
            // $article->setLabel((int)$request->get('label'));
            // $article->setPrice((int)$request->get('price'));
            // $article->setRef((int)$request->get('ref'));

            $repo = $this->getDoctrine()->getRepository(Storage::class);   
            $idStorage = $request->get('id_storage');
            $storage = $repo->find($idStorage);       
            
            $stored->setQty((int)$request->get('qty'));
            
            $article->addStoredList($stored);   
            
            $storage->addStoredList($stored);

            $manager->persist($article);
            $manager->flush();
            // $manager->persist($stored);
            // $manager->flush();
        
            return $this->redirectToRoute('article_list');
        }


        return $this->render('admin/create.html.twig', [
            'formArticle' => $formArticle->createView(),
            'editMode' => $article->getRef()!==null
        ]);
    }
/**
 * @Route("admin/delete", name="article_delete")
 */

    public function delete(Request $request, ArticleRepository $repo, ObjectManager $manager) {
        $article = $repo->findOneBy(['ref' => $request->get('ref')]);

        $storedList = $article->getStoredList();
        $storedDeletedIds = [];

        if (!$storedList->isEmpty()) {
            foreach ($storedList as $stored) {
                $article->removeStoredList($stored);
                
                $storedDeletedIds[] = $stored->getId();
                $manager->remove($stored);
                $manager->flush();
            }
        }

        $manager->remove($article);
        $manager->flush();

        return $this->json(['ref' => $article->getRef()]);
    }


/**
 * @Route("admin/list", name="article_list")
 */
    public function list( StoredRepository $repoS){

        //$articles =  $repo->findAll();

        $storedList = $repoS->findAll();

        //$storageList = $repoStorage->findAll();

        //dump($storedList); die();

        // foreach($articles as $article){
        //     $storedList = $repoS->findQty($article->getId());
        // }
          
        $list = [];

        foreach($storedList as $stored){
            $article = $stored->getArticles();

            if (isset($article)) {
                $a = [
                    "ref" => $article->getRef(),
                    "label" => $article->getLabel(),
                    "price" => $article->getPrice(),
                    "qty" => $stored->getQty(),
                    'nameStorage' => $stored->getStorages()->getLabel()
                ];
                $list[] = $a;   
            }
        }

        //dump($storageList);die();
        return $this->render('admin/list.html.twig', [
            'articles' => $list
        ]);
    }
}
