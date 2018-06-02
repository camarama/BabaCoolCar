<?php

namespace App\DataFixtures\ORM;

use App\Entity\Category;
use App\Entity\Page;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

         $category2 = $this->getReference('category2');
         $category3 = $this->getReference('category3');

         $page2 = new Page();
         $page2->setCategory($category2);
         $page2->setTitre('Comment ça marche');
         $page2->setContenu('<p>Ici on est sur la page de Comment ça marche</p>');
         $manager->persist($page2);

        $page3 = new Page();
        $page3->setCategory($category2);
        $page3->setTitre('Prix du covoiturage');
        $page3->setContenu('<p>Ici on est sur la page du Prix du covoiturage</p>');
        $manager->persist($page3);

        $page4 = new Page();
        $page4->setCategory($category2);
        $page4->setTitre('Charte de bonne conduite');
        $page4->setContenu('<p>Ici on est sur la page de la Charte de bonne conduite</p>');
        $manager->persist($page4);

        $page5 = new Page();
        $page5->setCategory($category2);
        $page5->setTitre('Contact');
        $page5->setContenu('<p>Ici on est sur la page de contact</p>');
        $manager->persist($page5);

        $page6 = new Page();
        $page6->setCategory($category3);
        $page6->setTitre('Qui sommes-nous ?');
        $page6->setContenu('<p>Ici on est sur la page de Qui sommes-nous ?</p>');
        $manager->persist($page6);

        $page7 = new Page();
        $page7->setCategory($category3);
        $page7->setTitre('Politique de confidentialité');
        $page7->setContenu('<p>Ici on est sur la page de la Politique de confidentialité</p>');
        $manager->persist($page7);

        $page8 = new Page();
        $page8->setCategory($category3);
        $page8->setTitre('Conditions générales');
        $page8->setContenu('<p>Ici on est sur la page des Conditions générales</p>');
        $manager->persist($page8);

        $page9 = new Page();
        $page9->setCategory($category3);
        $page9->setTitre('Utilisation des cookies');
        $page9->setContenu('<p>Ici on est sur la page d\'Utilisation des cookies</p>');
        $manager->persist($page9);

        $manager->flush();
    }
}
