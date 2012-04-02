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
use Pagerfanta\Pagerfanta,
    Pagerfanta\Adapter\DoctrineORMAdapter,
    Pagerfanta\Exception\NotValidCurrentPageException;

use HotDesign\SimpleCatalogBundle\Config\ItemTypes;

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
class ProductController extends Controller {

    /**
     * Retrieve and render the base entities listing by category, if slug is null, then retrieve all
     * items in all categories.
     * 
     * @return Response A Response instance 
     * 
     */
    public function indexAction($slug = NULL) {
        $level = 0; //default category level

        $em = $this->getDoctrine()->getEntityManager();
        $category_repo = $em->getRepository('SimpleCatalogBundle:Category');
        $category = NULL;

        //Get the repository and build a special query depending on the listing case
        $repo = $this->getDoctrine()->getEntityManager()->getRepository('SimpleCatalogBundle:BaseEntity');
        $query = $repo->createQueryBuilder('p')->orderBy('p.created_at', 'DESC');

        if ($slug) {
            $category = $category_repo->findOneBySlug($slug);

            if ($category) {
                $level = $category->getLvl();

                $has_children = $category->getChildren()->count();

                if ($has_children > 0) {
                    $level = $level + 1;
                }

                /**
                 *Get the related categories, this will be in a repository 
                 */
//                $query->where('p.category = :category_id')->setParameter('category_id', $category->getID());
                $categories = array();
                $categories[$category->getID()] = $category->getID();
                //TODO: MERGE AN ARRAY WITH CHILDRENS
                $category_filter_query = $em
                        ->createQueryBuilder()
                        ->select('node')
                        ->from('HotDesign\SimpleCatalogBundle\Entity\Category', 'node')
                        ->orderBy('node.root, node.lft', 'ASC')
                        ->where('node.root = ' . $category->getRoot() . ' AND node.lvl > ' . $category->getLvl())
                        ->getQuery();
                $tree = $category_filter_query->getArrayResult();

                if (is_array($tree)) {
                    foreach ($tree as $children_category) {
                        $children_id = $children_category['id'];
                        $categories[$children_id] = $children_id;
                    }
                }


                $query->add('where', $query->expr()->in('p.category', $categories));
            } else {
                throw $this->createNotFoundException('Unable to find Category entity.');
            }
        }

        /**
         * @todo: make $max_items_per_page configurable
         */
        $max_items_per_page = 10; //Default items per page 
        $current_page = $this->getRequest()->get('page', 1);

        //Build an adapter for pagerfanta, so he can paginate
        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);

        //Set options to pagerfanta
        $pagerfanta->setMaxPerPage($max_items_per_page);
        $pagerfanta->setCurrentPage($current_page);

        //Get the items filtered by the pager limit
        $entities = $pagerfanta->getCurrentPageResults();
        $num_pages = $pagerfanta->getNbPages(); //get the pages result, this is used in the template to hide/show the paginator

        $to_render = array(
            'category_level' => $level,
            'category' => $category,
            'entities' => $entities,
            'paginator' => $pagerfanta,
            'num_pages' => $num_pages,
        );

        return $this->render('HotDesignScThemeBundle:Product:listing_entities.html.twig', $to_render);
    }

    public function profileAction($category_slug, $slug) {
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('SimpleCatalogBundle:BaseEntity');
        $entity = $repo->findOneBySlug($slug);

        if (empty($entity)) {
            throw $this->createNotFoundException('Unable to find Entity entity.');
        }

        $current_category = $em->getRepository('SimpleCatalogBundle:Category')->findOneBySlug($category_slug);

        if (empty($current_category)) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $category_level = $current_category->getLvl();

        //Look entities wich extends


        /* ATENCION: COPIADO DESDE BaseEntityController.php refactorizar en algun futuro */
        /* ATENCION: COPIADO DESDE BaseEntityController.php refactorizar en algun futuro */
         //Obtenemos las Pics.
        $pics = $em->getRepository('SimpleCatalogBundle:Pic')->findBy(array('entity' => $entity->getId()));

        //Obtenemos el array de las clases que extiende
        $class_extends = ItemTypes::getClassExtends($entity->getCategory()->getType());

        $extends = array();

        //Recuperamos toda la información de las clases a las cuales extiende.
        foreach ($class_extends as $extend) {
            $e = array();
            $e['class'] = $extend['class'];
            $e['bundle_name'] = $extend['bundle_name'];
            $e['object'] = $em->getRepository(
                            $extend['bundle_name'] . ':' . $extend['class'])
                    ->findOneBy(array('base_entity' => $entity->getId())
            );
            $extends[] = $e;
        }
        /* ATENCION: COPIADO DESDE BaseEntityController.php refactorizar en algun futuro */
        /* ATENCION: COPIADO DESDE BaseEntityController.php refactorizar en algun futuro */
        /* ATENCION: COPIADO DESDE BaseEntityController.php refactorizar en algun futuro */


        $to_render = array(
            'category_level' => $category_level,
            'category' => $current_category,
            'entity' => $entity,
            'pics' => $pics,
            'extends' => $extends
        );

        return $this->render('HotDesignScThemeBundle:Product:entity_profile.html.twig', $to_render);
    }

}
