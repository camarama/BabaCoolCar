<?php

namespace App\DataFixtures\ORM;

use App\Entity\Marque;
use App\Entity\Modele;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MarqueFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $marque1 = new Marque();
         $marque1->setNom('Peugeot');
         $manager->persist($marque1);

         $marque2 = new Marque();
         $marque2->setNom('Renault');
         $manager->persist($marque2);

         $modele1 = new Modele();
         $modele1->setNom('307');
         $modele1->setMarque($marque1);
         $manager->persist($modele1);

         $modele2 = new Modele();
         $modele2->setNom('Laguna');
         $modele2->setMarque($marque2);
         $manager->persist($modele2);

         $modele3 = new Modele();
         $modele3->setNom('308');
         $modele3->setMarque($marque1);
         $manager->persist($modele3);

        $manager->flush();

        $this->addReference('marque1', $marque1);
        $this->addReference('marque2', $marque2);
    }
}
