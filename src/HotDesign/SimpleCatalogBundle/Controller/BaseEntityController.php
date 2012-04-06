<?php

namespace HotDesign\SimpleCatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HotDesign\SimpleCatalogBundle\Entity\BaseEntity;
use HotDesign\SimpleCatalogBundle\Form\BaseEntityType;
//Configs
use HotDesign\SimpleCatalogBundle\Config\Currencies;
use HotDesign\SimpleCatalogBundle\Config\ItemTypes;

use HotDesign\SimpleCatalogBundle\Config\MyConfig;

use Pagerfanta\Pagerfanta,
    Pagerfanta\Adapter\DoctrineORMAdapter,
    Pagerfanta\Exception\NotValidCurrentPageException;

/**
 * BaseEntity controller.
 *
 */
class BaseEntityController extends Controller {

    /**
     * Updates the relation between a BaseEntity and the Classes wich extends.
     *
     */
    private function UpdateBaseEntityLinks(\HotDesign\SimpleCatalogBundle\Entity\BaseEntity $entity) {
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BaseEntity entity.');
        }
        $em = $this->getDoctrine()->getEntityManager();

        //Buscamos las Extensiones a Cargar según la categoría
        $extends = ItemTypes::getClassExtends($entity->getCategory()->getType());

        foreach ($extends as $extend) {
            //Existe ya una instancia creada?
            $ext_entity = $em->getRepository($extend['bundle_name'] . ':' . $extend['class'])
                    ->findOneBy(array('base_entity' => $entity->getId()));

            if (!$ext_entity) {
                $ex = new $extend['entity']();
                $ex->setBaseEntity($entity);
                $em->persist($ex);
            }
        }

        $em->flush();
    }

    /**
     * Lists all BaseEntity entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        
    $max_items_per_page = MyConfig::$items_per_page_backend;
    $current_page = $this->getRequest()->get('page', 1);

    $repo = $this->getDoctrine()->getEntityManager()->getRepository('SimpleCatalogBundle:BaseEntity');
    $query = $repo->createQueryBuilder('p')->orderBy('p.created_at', 'DESC');

    $adapter = new DoctrineORMAdapter($query);
    $pagerfanta = new Pagerfanta($adapter);

    $pagerfanta->setMaxPerPage($max_items_per_page);
    $pagerfanta->setCurrentPage($current_page);


    $entities = $pagerfanta->getCurrentPageResults();
    $num_pages = $pagerfanta->getNbPages();
        

        return $this->render('SimpleCatalogBundle:BaseEntity:index.html.twig', array(
                    'entities' => $entities,
                    'pagination' => $pagerfanta,
                    'num_pages' => $num_pages,
                ));
    }

    /**
     * Displays a form to create a new BaseEntity entity.
     *
     */
    public function newAction() {
        $entity = new BaseEntity();
        $form = $this->createForm(new BaseEntityType(), $entity);

        return $this->render('SimpleCatalogBundle:BaseEntity:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                ));
    }

    /**
     * Creates a new BaseEntity entity.
     *
     */
    public function createAction() {
        //Obtaining the current user FosUserBundle 
        $user = $this->get('security.context')->getToken()->getUser();
        if(! $user instanceof \HotDesign\ScUserBundle\Entity\User)
        {
            throw $this->createNotFoundException('User not valid.');
        }
        $entity = new BaseEntity();
        $request = $this->getRequest();
        $form = $this->createForm(new BaseEntityType(), $entity);
        $form->bindRequest($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity->setPublisher($user);
            $em->persist($entity);
            $this->UpdateBaseEntityLinks($entity);
            $em->flush();

            $this->container->get('session')->setFlash('alert-success', 'Item agregado con éxito.');
            return $this->redirect($this->generateUrl('baseentity_edit', array('id' => $entity->getId())));
        } else {
            $this->container->get('session')->setFlash('alert-error', 'No se pudo crear el Item.');
        }

        return $this->render('SimpleCatalogBundle:BaseEntity:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                ));
    }

    /**
     * Displays a form to edit an existing BaseEntity entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SimpleCatalogBundle:BaseEntity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BaseEntity entity.');
        }
        
        //Updating links to Extension if any changes the category type for example.
        $this->UpdateBaseEntityLinks($entity);

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

        //End extends modifications
        $editForm = $this->createForm(new BaseEntityType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        //Aqui hay que ver como pasar un array con todos los forms a los q extiende...
        return $this->render('SimpleCatalogBundle:BaseEntity:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'pics' => $pics,
                    'extends' => $extends
                ));
    }

    /**
     * Edits an existing BaseEntity entity.
     *
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SimpleCatalogBundle:BaseEntity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BaseEntity entity.');
        }

        $editForm = $this->createForm(new BaseEntityType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->container->get('session')->setFlash('alert-success', 'El item se ha modificado con éxito.');
            return $this->redirect($this->generateUrl('baseentity_edit', array('id' => $id)));
        } else {

            $this->container->get('session')->setFlash('alert-error', 'No se pudo modificar el Item.');
        }


        return $this->render('SimpleCatalogBundle:BaseEntity:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Deletes a BaseEntity entity.
     *
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SimpleCatalogBundle:BaseEntity')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BaseEntity entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->container->get('session')->setFlash('alert-success', 'El item se ha eliminado con éxito.');
        } else {
            $this->container->get('session')->setFlash('alert-error', 'No se ha podido eliminar el Item.');
        }

        return $this->redirect($this->generateUrl('baseentity'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
