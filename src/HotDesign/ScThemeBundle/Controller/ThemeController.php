<?php
/**
 * This file is part of the SimpleCatalog Frontend package.
 *
 * (c) HotDesign <info@hotdesign.com.ar>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HotDesign\ScThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * ThemeController is the main controller, used to render static content, like
 * the homepage, about pages, etc
 * 
 * @author    HotDesign info@hotdesign.com.ar
 * @copyright GPL-v2 2012/01/30
 * @package   ScThemeBundle
 * @version   0.1
 * 
 */

class ThemeController extends Controller {
    
   /**
    * 
    * @param string $name the name of the twig template located on Resources/Theme/StaticPages
    * 
    * @return Response A Response instance  
    */
    public function indexAction($name) {
        return $this->render("HotDesignScThemeBundle:Theme/StaticPages:{$name}.html.twig");
    }

}
