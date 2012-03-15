<?php

namespace HotDesign\ScHousingExtBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use HotDesign\ScHousingExtBundle\Entity\ScHousingExt;
use HotDesign\ScHousingExtBundle\Form\ScHousingExtType;

/**
 * ScHousingExt controller.
 *
 */
class ScHousingExtController extends Controller
{
    /**
     * Lists all ScHousingExt entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ScHousingExtBundle:ScHousingExt')->findAll();

        return $this->render('ScHousingExtBundle:ScHousingExt:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a ScHousingExt entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ScHousingExtBundle:ScHousingExt')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScHousingExt entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ScHousingExtBundle:ScHousingExt:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new ScHousingExt entity.
     *
     */
    public function newAction()
    {
        $entity = new ScHousingExt();
        $form   = $this->createForm(new ScHousingExtType(), $entity);

        return $this->render('ScHousingExtBundle:ScHousingExt:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new ScHousingExt entity.
     *
     */
    public function createAction()
    {
        $entity  = new ScHousingExt();
        $request = $this->getRequest();
        $form    = $this->createForm(new ScHousingExtType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('schousingext_show', array('id' => $entity->getId())));
            
        }

        return $this->render('ScHousingExtBundle:ScHousingExt:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing ScHousingExt entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ScHousingExtBundle:ScHousingExt')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScHousingExt entity.');
        }

        $editForm = $this->createForm(new ScHousingExtType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ScHousingExtBundle:ScHousingExt:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing ScHousingExt entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ScHousingExtBundle:ScHousingExt')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScHousingExt entity.');
        }

        $editForm   = $this->createForm(new ScHousingExtType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            $this->container->get('session')->setFlash('alert-success', 'Cambios aplicados con éxito.');
            return $this->redirect($this->generateUrl('schousingext_edit', array('id' => $id)));
        }

        return $this->render('ScHousingExtBundle:ScHousingExt:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ScHousingExt entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ScHousingExtBundle:ScHousingExt')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ScHousingExt entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('schousingext'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
