<?php

namespace HotDesign\SimpleCatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HotDesign\SimpleCatalogBundle\Entity\ScGeoExt;
use HotDesign\SimpleCatalogBundle\Form\ScGeoExtType;

/**
 * ScGeoExt controller.
 *
 */
class ScGeoExtController extends Controller
{
    /**
     * Lists all ScGeoExt entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SimpleCatalogBundle:ScGeoExt')->findAll();

        return $this->render('SimpleCatalogBundle:ScGeoExt:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a ScGeoExt entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SimpleCatalogBundle:ScGeoExt')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScGeoExt entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SimpleCatalogBundle:ScGeoExt:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new ScGeoExt entity.
     *
     */
    public function newAction()
    {
        $entity = new ScGeoExt();
        $form   = $this->createForm(new ScGeoExtType(), $entity);

        return $this->render('SimpleCatalogBundle:ScGeoExt:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new ScGeoExt entity.
     *
     */
    public function createAction()
    {
        $entity  = new ScGeoExt();
        $request = $this->getRequest();
        $form    = $this->createForm(new ScGeoExtType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('scgeoext_show', array('id' => $entity->getId())));
            
        }

        return $this->render('SimpleCatalogBundle:ScGeoExt:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing ScGeoExt entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SimpleCatalogBundle:ScGeoExt')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScGeoExt entity.');
        }

        $editForm = $this->createForm(new ScGeoExtType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SimpleCatalogBundle:ScGeoExt:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing ScGeoExt entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SimpleCatalogBundle:ScGeoExt')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScGeoExt entity.');
        }

        $editForm   = $this->createForm(new ScGeoExtType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('scgeoext_edit', array('id' => $id)));
        }

        return $this->render('SimpleCatalogBundle:ScGeoExt:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ScGeoExt entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SimpleCatalogBundle:ScGeoExt')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ScGeoExt entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('scgeoext'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
