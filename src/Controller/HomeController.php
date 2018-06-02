<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }

    public function menuCategory(EntityManagerInterface $em)
    {
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('pages/modules/menu.html.twig', array('categories' => $categories));
    }

    /**
     * @Route("/page{id}", name="page")
     */
    public function page($id, EntityManagerInterface $em)
    {
        $page = $em->getRepository(Page::class)->find($id);

        if (!$page) throw $this->createNotFoundException('La page que vous demandez, n\'existe pas.');

        return $this->render('pages/page.html.twig', array('page' => $page));
    }
}
