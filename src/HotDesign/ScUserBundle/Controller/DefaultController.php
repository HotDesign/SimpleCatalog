<?php

namespace HotDesign\ScUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('ScUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
