<?php

namespace HotDesign\SimpleCatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HotDesign\SimpleCatalogBundle\Entity\BaseEntity;
use HotDesign\SimpleCatalogBundle\Form\BaseEntityType;
use HotDesign\SimpleCatalogBundle\Entity\ItemTypes;

/**
 * BaseEntity controller.
 *
 */
class BaseEntityController extends Controller {

    /**
     * Lists all BaseEntity entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SimpleCatalogBundle:BaseEntity')->findAll();

        return $this->render('SimpleCatalogBundle:BaseEntity:index.html.twig', array(
                    'entities' => $entities
                ));
    }

    /**
     * Finds and displays a BaseEntity entity.
     *
     */
//    public function showAction($id)
//    {
//        $em = $this->getDoctrine()->getEntityManager();
//
//        $entity = $em->getRepository('SimpleCatalogBundle:BaseEntity')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find BaseEntity entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('SimpleCatalogBundle:BaseEntity:show.html.twig', array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),
//
//        ));
//    }

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
        $entity = new BaseEntity();
        $request = $this->getRequest();
        $form = $this->createForm(new BaseEntityType(), $entity);
        $form->bindRequest($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);

            //Vemos a que Tipos Extiende
            $extends = ItemTypes::getClassExtends($entity->getCategory()->getType());
            //Creamos un objeto por cada uno y le asignamos el parent, luego persistimos
            foreach ($extends as $extend) {
                $clase = 'HotDesign\SimpleCatalogBundle\Entity\\' . $extend;
                
                $ex = new $clase();
                $ex->setBaseEntity($entity);
                $em->persist($ex);
            }


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

        //Obtenemos las Pics.
        $pics = $em->getRepository('SimpleCatalogBundle:Pic')->findBy(array('entity' => $entity->getId()));

        //Obtenemos el array de las clases que extiende
        $class_extends = ItemTypes::getClassExtends($entity->getCategory()->getType());

        $extend = array();

        //Recuperamos toda la información de las clases a las cuales extiende.
        foreach ($class_extends as $class) {
            $e = array();
            $e['class'] = $class;
            $e['object'] = $em->getRepository('SimpleCatalogBundle:' . $class)->findOneBy(array('base_entity' => $entity->getId()));
            $extend[] = $e;
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
                    'extends' => $extend
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
