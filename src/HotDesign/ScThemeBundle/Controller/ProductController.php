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
use	Pagerfanta\Pagerfanta,
	Pagerfanta\Adapter\DoctrineORMAdapter,
	Pagerfanta\Exception\NotValidCurrentPageException;
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
    
    public function indexAction($slug) {
        $level = 1;
        
        $em = $this->getDoctrine()->getEntityManager();
        $category_repo = $em->getRepository('SimpleCatalogBundle:Category');
        $category = $category_repo->findOneBySlug($slug);
        
        if ($category) {
            $level = $category->getLvl();
            
            $has_children = $category->getChildren()->count();
            
            if ($has_children > 0) {
                $level = $level + 1;
            }
        }
        
        $max_items_per_page = 10;
        $current_page = $this->getRequest()->get('page', 1);

        $repo = $this->getDoctrine()->getEntityManager()->getRepository('SimpleCatalogBundle:BaseEntity');
        $query = $repo->createQueryBuilder('p')->orderBy('p.updated_at', 'DESC');
        
        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        
        $pagerfanta->setMaxPerPage($max_items_per_page);
        $pagerfanta->setCurrentPage($current_page);
        
        
        $entities = $pagerfanta->getCurrentPageResults();
        $num_pages = $pagerfanta->getNbPages();
        
        return $this->render('HotDesignScThemeBundle:Product:index.html.twig', array(
                    'category_level' => $level,
                    'category' => $category,
                     'entities' => $entities,
                     'paginator' => $pagerfanta,
                     'num_pages' => $num_pages,
                        )
        );
    }
    
    public function profileAction()
    {
        return $this->render('HotDesignScThemeBundle:Default:index.html.twig');
    }
}
