<?php

namespace HotDesign\ScThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ProductController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('HotDesignScThemeBundle:Default:index.html.twig');
    }
}
