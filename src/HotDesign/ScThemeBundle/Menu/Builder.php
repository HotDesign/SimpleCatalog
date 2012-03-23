<?php

/**
 * This file is part of the SimpleCatalog Frontend package.
 *
 * (c) HotDesign <info@hotdesign.com.ar>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HotDesign\ScThemeBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Builder Menu class, this class is used to define the menu and them items
 * 
 * @author    HotDesign info@hotdesign.com.ar
 * @copyright GPL-v2 2012/01/30
 * @package   ScThemeBundle
 * @version   0.1
 * 
 */
class Builder extends ContainerAware {

    /**
     * The main menu of the site, for example will render Home, About and Contact, etc
     * 
     * @param FactoryInterface $factory
     * @param array $options
     * @return FactoryInterface 
     */
    public function mainMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        $menu->setCurrentUri($this->container->get('request')->getRequestUri());
        $menu->setCurrent(TRUE);

        $menu->addChild('Inicio', array('route' => 'homepage'));

        $menu->addChild('Productos', array('route' => 'products_homepage'));

        $menu->addChild('Acerca', array(
            'route' => 'static_page',
            'routeParameters' => array('name' => 'about'),
        ));


        $menu->addChild('Donde estamos', array(
            'route' => 'contact',
        ));

        $menu->setChildrenAttribute('class', 'nav');

        
        //Retrieve if we are listing products from categories
        $path_info = $this->container->get('request')->getRequestUri();
        $products_path = $this->container->get('router')->generate('products_homepage');

        //If the URLs match, then set the product navbar item as selected
        if (strstr($path_info, $products_path)) {
            $menu->setCurrentUri($products_path);
            $menu->setCurrent(TRUE);
        }

        return $menu;
    }

}