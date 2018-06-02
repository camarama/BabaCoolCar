<?php

namespace App\DataFixtures\ORM;

use App\Entity\Adresse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AdresseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $adresse1 = new Adresse();
        $adresse1->setLieudepart('Conakry');
        $adresse1->setLieudestination('Boke');
        $manager->persist($adresse1);

        $adresse2 = new Adresse();
        $adresse2->setLieudepart('Kindia');
        $adresse2->setLieudestination('Fria');
        $manager->persist($adresse2);

        $adresse3 = new Adresse();
        $adresse3->setLieudepart('Boke');
        $adresse3->setLieudestination('Conakry');
        $manager->persist($adresse3);

        $adresse4 = new Adresse();
        $adresse4->setLieudepart('Conakry');
        $adresse4->setLieudestination('Kindia');
        $manager->persist($adresse4);

        $adresse5 = new Adresse();
        $adresse5->setLieudepart('Conakry');
        $adresse5->setLieudestination('Kindia');
        $manager->persist($adresse5);

        $manager->flush();

        $this->addReference('adresse1', $adresse1);
        $this->addReference('adresse2', $adresse2);
        $this->addReference('adresse3', $adresse3);
        $this->addReference('adresse4', $adresse4);
        $this->addReference('adresse5', $adresse5);
    }
}
