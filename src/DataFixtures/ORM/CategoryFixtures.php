<?php

namespace App\DataFixtures\ORM;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category2 = new Category();
        $category2->setNom('Infos pratiques');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setNom('À propos');
        $manager->persist($category3);

        $manager->flush();

        $this->addReference('category2', $category2);
        $this->addReference('category3', $category3);
    }
}
