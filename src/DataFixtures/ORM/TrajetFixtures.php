<?php

namespace App\DataFixtures\ORM;

use App\Entity\Adresse;
use App\Entity\Etape;
use App\Entity\Trajet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TrajetFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $vehicule1 = $this->getReference('vehicule1');
        $vehicule2 = $this->getReference('vehicule2');
        $adresse1 = $this->getReference('adresse1');
        $adresse2 = $this->getReference('adresse2');
        $adresse3 = $this->getReference('adresse3');
        $adresse4 = $this->getReference('adresse4');
        $adresse5 = $this->getReference('adresse5');

         $trajet1 = new Trajet();
         $trajet1->setVehicule($vehicule1);
         $trajet1->setCreatedAt(new \DateTime('now'));
         $trajet1->setDatedepart(new \DateTime('tomorrow'));
         $trajet1->setNbplace(2);
         $manager->persist($trajet1);

        $trajet2 = new Trajet();
        $trajet2->setVehicule($vehicule2);
        $trajet2->setCreatedAt(new \DateTime('tomorrow'));
        $trajet2->setDatedepart(new \DateTime('+10 days'));
        $trajet2->setNbplace(4);
        $manager->persist($trajet2);

        $trajet3 = new Trajet();
        $trajet3->setVehicule($vehicule1);
        $trajet3->setCreatedAt(new \DateTime('now'));
        $trajet3->setDatedepart(new \DateTime('+3 days'));
        $trajet3->setNbplace(4);
        $manager->persist($trajet3);

        $trajet4 = new Trajet();
        $trajet4->setVehicule($vehicule2);
        $trajet4->setCreatedAt(new \DateTime('+5 days'));
        $trajet4->setDatedepart(new \DateTime('+3 days'));
        $trajet4->setNbplace(1);
        $manager->persist($trajet4);

        $trajet5 = new Trajet();
        $trajet5->setVehicule($vehicule1);
        $trajet5->setCreatedAt(new \DateTime('+7 days'));
        $trajet5->setDatedepart(new \DateTime('+2 days'));
        $trajet5->setNbplace(5);
        $manager->persist($trajet5);

        $etape1 = new Etape();
        $etape1->setHeureetape(new \DateTime('15:00:00') );
        $etape1->setTrajet($trajet1);
        $etape1->setPrixetape(15000);
        $etape1->setAdresse($adresse1);
        $manager->persist($etape1);

        $etape2 = new Etape();
        $etape2->setHeureetape(new \DateTime('09:30:00'));
        $etape2->setTrajet($trajet2);
        $etape2->setNometape('Conakry');
        $etape2->setPrixetape(55000);
        $etape2->setAdresse($adresse2);
        $manager->persist($etape2);

        $etape3 = new Etape();
        $etape3->setHeureetape(new \DateTime('20:10:00'));
        $etape3->setTrajet($trajet3);
        $etape3->setNometape('Dubreka, Matoto');
        $etape3->setPrixetape(15000);
        $etape3->setAdresse($adresse3);
        $manager->persist($etape3);

        $etape4 = new Etape();
        $etape4->setHeureetape(new \DateTime('20:10:00'));
        $etape4->setTrajet($trajet4);
//        $etape4->setNometape('conakry, kin');
        $etape4->setPrixetape(75000);
        $etape4->setAdresse($adresse4);
        $manager->persist($etape4);

        $etape5 = new Etape();
        $etape5->setHeureetape(new \DateTime('20:10:00'));
        $etape5->setTrajet($trajet5);
//        $etape4->setNometape('conakry, kin');
        $etape5->setPrixetape(85000);
        $etape5->setAdresse($adresse5);
        $manager->persist($etape5);

        $manager->flush();

        $this->addReference('trajet1', $trajet1);
        $this->addReference('trajet2', $trajet2);
        $this->addReference('trajet3', $trajet3);
        $this->addReference('trajet4', $trajet4);
        $this->addReference('trajet5', $trajet5);
    }
}
