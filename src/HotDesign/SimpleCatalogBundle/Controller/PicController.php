<?php

namespace HotDesign\SimpleCatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HotDesign\SimpleCatalogBundle\Entity\Pic;
use HotDesign\SimpleCatalogBundle\Form\PicType;

/**
 * Pic controller.
 *
 */
class PicController extends Controller {

    public function getBaseEntity($id_baseentity) {
        $em = $this->getDoctrine()->getEntityManager();
        $out = $em->getRepository('SimpleCatalogBundle:BaseEntity')->find($id_baseentity);

        if (!$out)
            die("Aca excepcion por no encontrar baseentity");

        return $out;
    }

    /**
     * Lists all Pic entities de una baseentity
     *
     */
    public function galleryAction($id_baseentity) {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SimpleCatalogBundle:Pic')->findAll(array('entity' => $id_baseentity));
        $baseentity = $this->getBaseEntity($id_baseentity);

        return $this->render('SimpleCatalogBundle:Pic:gallery.html.twig', array(
                    'entities' => $entities,
                    'baseentity' => $baseentity
                ));
    }

    /**
     * Lists all Pic entities.
     * Medio como q no se usa
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SimpleCatalogBundle:Pic')->findAll();

        return $this->render('SimpleCatalogBundle:Pic:index.html.twig', array(
                    'entities' => $entities
                ));
    }

    /**
     * Finds and displays a Pic entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SimpleCatalogBundle:Pic')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pic entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SimpleCatalogBundle:Pic:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Displays a form to create a new Pic entity.
     *
     */
    public function newAction($id_baseentity) {
        $baseentity = $this->getBaseEntity($id_baseentity);

        $entity = new Pic();
        $entity->setEntity($baseentity);

        $form = $this->createForm(new PicType(), $entity);

        return $this->render('SimpleCatalogBundle:Pic:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'baseentity' => $baseentity
                ));
    }

    /**
     * Creates a new Pic entity.
     *
     */
    public function createAction($id_baseentity) {
        $baseentity = $this->getBaseEntity($id_baseentity);

        $entity = new Pic();
        $entity->setEntity($baseentity);
        
        $request = $this->getRequest();
        $form = $this->createForm(new PicType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            //Hacemos el proceso de Upload
            $entity->upload();

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pic_show', array('id' => $entity->getId())));
        }

        return $this->render('SimpleCatalogBundle:Pic:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                ));
    }

    /**
     * Displays a form to edit an existing Pic entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SimpleCatalogBundle:Pic')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pic entity.');
        }

        $editForm = $this->createForm(new PicType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SimpleCatalogBundle:Pic:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Edits an existing Pic entity.
     *
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SimpleCatalogBundle:Pic')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pic entity.');
        }

        $editForm = $this->createForm(new PicType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pic_edit', array('id' => $id)));
        }

        return $this->render('SimpleCatalogBundle:Pic:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Deletes a Pic entity.
     *
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SimpleCatalogBundle:Pic')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pic entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pic'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
