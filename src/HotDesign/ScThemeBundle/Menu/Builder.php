<?php

namespace HotDesign\ScThemeBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware {
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setCurrentUri($this->container->get('request')->getRequestUri());
        $menu->setCurrent(TRUE);
        
        $menu->addChild('Inicio', array('route' => 'homepage'));
        
        $menu->addChild('Acerca', array(
          'route' => 'static_page',
          'routeParameters' => array('name' => 'about'),
        ));
        
        $menu->addChild('Donde estamos', array(
          'route' => 'contact',
        ));
      
        $menu->setChildrenAttribute('class', 'nav');
       
        return $menu;
    }
}