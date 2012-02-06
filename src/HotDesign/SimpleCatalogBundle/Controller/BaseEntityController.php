<?php

namespace HotDesign\SimpleCatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HotDesign\SimpleCatalogBundle\Entity\BaseEntity;
use HotDesign\SimpleCatalogBundle\Form\BaseEntityType;

/**
 * BaseEntity controller.
 *
 */
class BaseEntityController extends Controller
{
    /**
     * Lists all BaseEntity entities.
     *
     */
    public function indexAction()
    {
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
    public function newAction()
    {
        $entity = new BaseEntity();
        $form   = $this->createForm(new BaseEntityType(), $entity);

        return $this->render('SimpleCatalogBundle:BaseEntity:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new BaseEntity entity.
     *
     */
    public function createAction()
    {
        $entity  = new BaseEntity();
        $request = $this->getRequest();
        $form    = $this->createForm(new BaseEntityType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('baseentity_show', array('id' => $entity->getId())));
            
        }

        return $this->render('SimpleCatalogBundle:BaseEntity:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing BaseEntity entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SimpleCatalogBundle:BaseEntity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BaseEntity entity.');
        }

        $editForm = $this->createForm(new BaseEntityType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SimpleCatalogBundle:BaseEntity:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing BaseEntity entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SimpleCatalogBundle:BaseEntity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BaseEntity entity.');
        }

        $editForm   = $this->createForm(new BaseEntityType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('baseentity_edit', array('id' => $id)));
        }

        return $this->render('SimpleCatalogBundle:BaseEntity:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BaseEntity entity.
     *
     */
    public function deleteAction($id)
    {
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
        }

        return $this->redirect($this->generateUrl('baseentity'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
