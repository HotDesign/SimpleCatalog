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
use HotDesign\SimpleCatalogBundle\Config\MyConfig;

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
    public function indexAction($slug = NULL, $_format = 'html') {
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
                $query->where("p.category = '{$category->getID()}'");
            } else {
                throw $this->createNotFoundException('Unable to find Category entity.');
            }
        }

        /**
         * @todo: make $max_items_per_page configurable
         */
        $current_page = (int) $this->getRequest()->get('page', 1);

        if ($current_page == 0) {
            $max_items_per_page = 9999999;
        } else {
            $max_items_per_page = MyConfig::$items_per_pages; //Default items per page 
        }
        //Build an adapter for pagerfanta, so he can paginate
        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);

        //Set options to pagerfanta
        $pagerfanta->setMaxPerPage($max_items_per_page);
        $pagerfanta->setCurrentPage($current_page);

        //Get the items filtered by the pager limit
        $entities = $pagerfanta->getCurrentPageResults();
        $num_pages = $pagerfanta->getNbPages(); //get the pages result, this is used in the template to hide/show the paginator


        $output_tmp_entities = array();
        switch ($_format) {
            case 'xml':
            case 'json':
                if ($entities) {
                    // view this in future
                    /**
                     *$serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new 
JsonEncoder()));
$json = $serializer->serialize($entity, 'json'); 
                     */
                    foreach ($entities as $entity) {
                        $tmp_category = $entity->getCategory();

                        $tmp_entity = array(
                            'title' => $entity->getTitle(),
                            'id' => $entity->getid(),
                            'url' => $this->get('router')->generate('product_profile', array('slug' => $entity->getSlug(), 'category_slug' => $tmp_category->getSlug()), TRUE),
                            'description' => $entity->getDescription(),
                            'category' => $tmp_category->getTitle(),
                            'category_url' => $this->get('router')->generate('products_listing', array('slug' => $tmp_category->getSlug()), TRUE),
                            'created_at' => $entity->getCreatedAt(),
                            'updated_at' => $entity->getUpdatedAt(),
                        );

                        $tmp_entity['pics'] = array();

                        $tmp_pictures = $entity->getPics();
                        if (count($tmp_pictures) > 0) {
                            $default_pic = $entity->get_default_pic();
                             
                            $request = $this->get('request');
                            $web_url = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath().'/';
                            $tmp_entity['pics'][0] = $web_url.$default_pic->getWebPath();

                            foreach ($tmp_pictures as $pic) {
                                if ($pic->getId() != $default_pic->getId()) {
                                    $tmp_entity['pics'][$pic->getId()] = $web_url.$pic->getWebPath();
                                }
                            }
                        }

                        $output_tmp_entities[$entity->getId()] = $tmp_entity;
                    }
                }
                
                $entities = $output_tmp_entities;
                break;
        }

        $to_render = array(
            'category_level' => $level,
            'category' => $category,
            'paginator' => $pagerfanta,
            'num_pages' => $num_pages,
            'entities' => $entities,
        );

        if ($_format == 'json') {
            unset($to_render['paginator']);
            $to_render['to_render'] = $to_render;
        }
        return $this->render("HotDesignScThemeBundle:Product:listing_entities.{$_format}.twig", $to_render);
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
            $extends[$e['class']] = $e;
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
