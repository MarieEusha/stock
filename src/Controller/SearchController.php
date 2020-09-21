<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
// use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\Serializer\Serializer;

class SearchController extends AbstractController
{
    /**
     * @Route("search/list", name="search")
     */

    public function search(Request $request,ArticleRepository $repo){
       
        if(is_numeric($request->get('search'))){
            $articles = $repo->findBy(['ref' => $request->get('search')]);
        }else{
            $articles = $repo->findBy(['label' => $request->get('search')]);
        }

        $articlesList = $this->getArticlesListFormatted($articles);

        return $this->json(['articles'=> $articlesList]);
    }

    /**
     * @Route("search/interval", name="interval")
     */

    public function interval(Request $request,ArticleRepository $repo){
        $prixMin = $request->query->get('prixMin');
        $prixMax = $request->query->get('prixMax');

        $articles = $repo->findByPrice($prixMin,$prixMax);   
        
        $articlesList = $this->getArticlesListFormatted($articles);

        return $this->json(['articles'=> $articlesList]);
    }


    /**
     * @Route("/index/search", name="index_search")
     */
    public function index()
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    /**
     * Toto.
     */
    private function getArticlesListFormatted(array $articles)
    {
        $articlesList = [];

        if (isset($articles) && is_array($articles) && count($articles) > 0) {
            foreach ($articles as $article) {
                $tmpArticle = [
                    'ref'   => $article->getRef(),
                    'label' => $article->getLabel(),
                    'price' => $article->getPrice(),
                ];

                $articlesList[] = $tmpArticle;
            }
        }

        return $articlesList;
    }
}
