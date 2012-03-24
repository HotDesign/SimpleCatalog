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
class CategoryController extends Controller {
    /**
     *  Render the template in the product listing navbar
     * @return Response A Response instance 
     */
    public function renderTemplateCategoriesAction($current_level, $category = NULL) {
        $em = $this->getDoctrine()->getEntityManager();

        $wheres = array(
            'lvl' => $current_level,
        );
        
        if ($category) {
            $wheres['root'] = $category->getRoot();
        }
        
        $entities = $em->getRepository('SimpleCatalogBundle:Category')->findBy($wheres, array('title' => 'ASC', 'lft' => 'ASC'));

        return $this->render('HotDesignScThemeBundle:Category:navigation_menu.html.twig', array('entities' => $entities, 'category' => $category));
    }
    
    public function renderCategoryBreadcumbAction($category) {
//        $em = $this->getDoctrine()->getEntityManager();

//        $entities = $em->getRepository('SimpleCatalogBundle:Category')->findBy(array('lvl' => $current_level), array('title' => 'ASC', 'lft' => 'ASC'));
        $parent_items = array();
        
        $parent = $category->getParent();
        
        while($parent && $parent->getLvl() >= 0) {
            $parent_items[] = $parent;
            $parent = $parent->getParent();
        }
        
        $parent_items = array_reverse($parent_items);
        
        return $this->render('HotDesignScThemeBundle:Category:category_breadcumb.html.twig', array('parent_items' => $parent_items, 'current_category' => $category));
    }

}
