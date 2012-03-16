<?php

namespace HotDesign\ScThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ContactController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('HotDesignScThemeBundle:Contact:index.html.twig');
    }
}
