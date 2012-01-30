<?php

namespace HotDesign\SimpleCatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HotDesign\SimpleCatalogBundle\Entity\Category;
use Utils;

class DefaultController extends Controller {

    public function indexAction($name) {

//          echo Utils::getSlug('asdfasd fads fadsf ads NNNN ññññ enneiee .... asd sad as');
//          die;
//        $em = $this->get('doctrine')->getEntityManager();
//
//        $repo = $em->getRepository('SimpleCatalogBundle:Category');
//
//        $arrayTree = $repo->childrenHierarchy();
//
//        foreach ($arrayTree as $arr) {
//            $arr['title'] = str_repeat('_', $arr['lvl']) .   $arr['title'];
//            
//        }
//        $options = array(
//            'decorate' => true,
//            'rootOpen' => '<ul>',
//            'rootClose' => '</ul>',
//            'childOpen' => '<li>',
//            'childClose' => '</li>',
//            'nodeDecorator' => function($node) {
//                return '<a href="/page/' . $node['id'] . '">' . str_repeat('_', $node['lvl']) . $node['title'] . '</a>';
//            }
//        );
//        $htmlTree = $repo->childrenHierarchy(
//                null, /* starting from root nodes */ false, /* load all children, not only direct */ $options
//        );
//
//        echo '<pre>';
//        print_r($arrayTree);
//        echo '</pre>';
//
//        die;
        return $this->render('SimpleCatalogBundle:Layouts:base.html.twig', array('name' => $name));
    }

}
