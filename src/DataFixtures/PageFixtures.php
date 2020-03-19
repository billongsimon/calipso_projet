<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
Use App\Entity\Page;
Use App\Entity\Categorie;

class PageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
    for($i=1;$i<6;$i++)
    {
        $categorie =new Categorie();
        $categorie->setTitre("titre". $i);
        $manager->persist($categorie);
        for($j=1;$j<20;$j++)
         {
          $page =new Page();
        $page->setTitre("titrepage" . $j)
        ->setAuteur("auteur" .$j)
        ->setCreatedAt(new \DateTime())
        ->setDateJourAt(new \DateTime())
        ->setContenu("contenu" . $j)
        ->setCategorie($categorie);
        $manager->persist($page);
        }
    }
        $manager->flush();
    }
}
