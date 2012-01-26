<?php

namespace HotDesign\SimpleCatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HotDesign\SimpleCatalogBundle\Entity\Category;

class DefaultController extends Controller {

    public function indexAction($name) {

        $em = $this->get('doctrine')->getEntityManager();
        $c = new Category();

        $c->setTitle('Categorías Base');
        $c->setDescription('Categoría Padre de Todas');
        

        $em->persist($c);
        $em->flush();

        return $this->render('SimpleCatalogBundle:Layouts:base.html.twig', array('name' => $name));
    }

}
