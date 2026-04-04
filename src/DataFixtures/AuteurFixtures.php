<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuteurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         for($i = 1; $i <= 20; $i++) {
            $auteur = new Auteur;
            $auteur->setNom("Auteur $i");
            $auteur->setBiographie("Biographie de l'auteur $i");

            $manager->persist($auteur);
        }
        $manager->flush();
    }
}