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
 * CategoryController will retrieve and display the items in some category
 * 
 * @author    HotDesign info@hotdesign.com.ar
 * @copyright GPL-v2 2012/01/30
 * @package   ScThemeBundle
 * @version   0.1
 * 
 */
class CategoryController extends Controller
{
    /**
     * Retrieves items that are in some category
     * 
     * @return Response A Response instance 
     * 
     */
    public function indexAction()
    {
        return $this->render('HotDesignScThemeBundle:Theme:index.html.twig');
    }
}
