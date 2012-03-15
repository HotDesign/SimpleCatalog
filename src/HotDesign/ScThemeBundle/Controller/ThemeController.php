<?php

namespace HotDesign\ScThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ThemeController extends Controller {
    
    public function indexAction($name) {
        return $this->render("HotDesignScThemeBundle:Theme/StaticPages:{$name}.html.twig");
    }

}
