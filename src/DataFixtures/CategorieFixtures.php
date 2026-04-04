<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         for($i = 1; $i <= 20; $i++) {
            $categorie = new Categorie;
            $categorie->setLibelle("Catégorie $i");
            $categorie->setDescription("Description de la catégorie $i");

            $manager->persist($categorie);
        }
        $manager->flush();
    }
}