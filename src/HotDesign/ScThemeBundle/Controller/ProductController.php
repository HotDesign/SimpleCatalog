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
 * ProductController is the main frontend controller to retrieve and display 
 * items profiles
 * 
 * @author    HotDesign info@hotdesign.com.ar
 * @copyright GPL-v2 2012/01/30
 * @package   ScThemeBundle
 * @version   0.1
 * 
 */

class ProductController extends Controller
{
     /**
     * Retrieve the item and display the profile.
     * 
     * @return Response A Response instance 
     * 
     */
    
    public function indexAction()
    {
        return $this->render('HotDesignScThemeBundle:Default:index.html.twig');
    }
}
