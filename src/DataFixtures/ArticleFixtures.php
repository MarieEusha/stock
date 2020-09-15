<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i=1; $i <=10; $i++){
            $article = new Article();
            $article
                    ->setLabel("Article $i")
                    ->setPrice("20")
                    ->setRef("01$i");

            $manager->persist($article);
        }        

        $manager->flush();
    }
}
