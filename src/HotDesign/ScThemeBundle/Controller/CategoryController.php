<?php

namespace HotDesign\ScThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CategoryController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('HotDesignScThemeBundle:Theme:index.html.twig');
    }
}
