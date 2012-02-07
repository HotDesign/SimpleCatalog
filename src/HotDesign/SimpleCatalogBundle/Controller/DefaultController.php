<?php

namespace HotDesign\SimpleCatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HotDesign\SimpleCatalogBundle\Entity\Category;
use Utils;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('SimpleCatalogBundle:Layouts:base.html.twig');
    }

}
