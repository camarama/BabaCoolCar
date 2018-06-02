<?php

namespace App\DataFixtures\ORM;

use App\Entity\Membre;
use App\Entity\Vehicule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class MembreFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
         $user1 = new Membre();
         $user1->setEmail('coura@me.fr');
         $user1->setNom('Sambou');
         $user1->setPrenom('coura');
         $user1->setTelephone('0614025369');
         $password = $this->encoder->encodePassword($user1, 'coura');
         $user1->setPassword($password);
         $user1->setCreatedAt(new \DateTime('yesterday'));
         $user1->setEnabled(true);
         $manager->persist($user1);

        $user2 = new Membre();
        $user2->setEmail('alpha@me.fr');
        $user2->setNom('Diallo');
        $user2->setPrenom('alpha');
        $user2->setTelephone('0715849632');
        $password = $this->encoder->encodePassword($user2, 'alpha');
        $user2->setPassword($password);
        $user2->setCreatedAt(new \DateTime('now'));
        $user2->setEnabled(true);
        $manager->persist($user2);

        $user3 = new Membre();
        $user3->setEmail('prince@me.fr');
        $user3->setNom('Dougouno');
        $user3->setPrenom('Prince');
        $user3->setTelephone('0654856323');
        $password = $this->encoder->encodePassword($user3, 'prince');
        $user3->setPassword($password);
        $user3->setCreatedAt(new \DateTime('yesterday'));
        $user3->setEnabled(true);
        $manager->persist($user3);

        $user4 = new Membre();
        $user4->setEmail('rama@me.fr');
        $user4->setNom('Sambou');
        $user4->setPrenom('rama');
        $user4->setTelephone('0627584123');
        $password = $this->encoder->encodePassword($user4, 'rama');
        $user4->setPassword($password);
        $user4->setCreatedAt(new \DateTime('tomorrow'));
        $user4->setEnabled(true);
        $manager->persist($user4);

        $user5 = new Membre();
        $user5->setEmail('mama@me.fr');
        $user5->setNom('Diakite');
        $user5->setPrenom('mama');
        $user5->setTelephone('0758789418');
        $password = $this->encoder->encodePassword($user5, 'mama');
        $user5->setPassword($password);
        $user5->setCreatedAt(new \DateTime('now'));
        $user5->setEnabled(true);
        $manager->persist($user5);

        $marque1 = $this->getReference('marque1');
        $marque2 = $this->getReference('marque2');

        $vehicule1 = new Vehicule();
        $vehicule1->setMembre($user1);
        $vehicule1->setMarque($marque1);
        $vehicule1->setImmatriculation('df-176-mp');
        $vehicule1->setCouleur('bleu');
        $manager->persist($vehicule1);

        $vehicule2 = new Vehicule();
        $vehicule2->setMembre($user2);
        $vehicule2->setMarque($marque2);
        $vehicule2->setImmatriculation('sd-456-jk');
        $vehicule2->setCouleur('rouge');
        $manager->persist($vehicule2);

        $manager->flush();

        $this->addReference('vehicule1', $vehicule1);
        $this->addReference('vehicule2', $vehicule2);
    }
}
