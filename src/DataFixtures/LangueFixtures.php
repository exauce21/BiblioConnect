<?php

namespace App\DataFixtures;

use App\Entity\Langue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LangueFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         for($i = 1; $i <= 20; $i++) {
            $langue = new Langue;
            $langue->setTitre("Langue $i");
            $langue->setCode("CODE0$i");

            $manager->persist($langue);
        }
        $manager->flush();
    }
}