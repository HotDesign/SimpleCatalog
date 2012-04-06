<?php

namespace HotDesign\SimpleCatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HotDesign\SimpleCatalogBundle\Entity\Pic;
use HotDesign\SimpleCatalogBundle\Form\PicType;
use HotDesign\SimpleCatalogBundle\Validator\ImageAttachmentLimitConstraint;
use HotDesign\SimpleCatalogBundle\Validator\ImageAttachmentLimitConstraintValidator;

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

        $entities = $em->getRepository('SimpleCatalogBundle:Pic')
        ->findBy( array('entity' => $id_baseentity) );
        
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

    //Esta función, toma el id de una pic 
    //Setea como is_default = true para ella
    // y        is_default = false para todas las demas.
    public function setdefaultpicAction($pic_id) {
        $em = $this->getDoctrine()->getEntityManager();

        $pic_default = $em->getRepository('SimpleCatalogBundle:Pic')
                    ->findOneBy( array('id' => $pic_id) );

        $pics = $em->getRepository('SimpleCatalogBundle:Pic')
                    ->findBy( array( 'entity' => $pic_default->getEntity()->getId() ) );

        foreach ($pics as $pic) {
            if ( $pic->getId() == $pic_id )
                $pic->setIsDefault(true);
            else
                $pic->setIsDefault(false);
            $em->persist($pic);
        }
        
        $em->flush();
        $this->container->get('session')->setFlash('alert-success', 'La imágen ha sido definida como principal.');
        return $this->redirect($this->generateUrl('pic_gallery', array('id_baseentity' => $pic_default->getEntity()->getId()) ));
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

            $validator = $this->get('validator_image_limit_number');

            //If this is the first image of the item
            //We make it as the default one.
            $any_pic = $em->getRepository('SimpleCatalogBundle:Pic')
                ->findByEntity($id_baseentity);

            $imageNumber = count($any_pic);

            $imgconstraint = new ImageAttachmentLimitConstraint();

            if (!$validator->isValid($imageNumber, $imgconstraint)) {
                $this->container->get('session')->setFlash('alert-error', $imgconstraint->message);
            } else {
                //Upload process
                $entity->upload();

                if (!$any_pic)
                    $entity->setIsDefault (true);

                $em->persist($entity);
                $em->flush();

                $this->container->get('session')->setFlash('alert-success', 'Imágen agregada con éxito.');

                return $this->redirect($this->generateUrl('pic_edit', array('id' => $entity->getId())));
            }
        } else {
            $this->container->get('session')->setFlash('alert-error', 'No se pudo agregar la imágen.');
        }
        return $this->render('SimpleCatalogBundle:Pic:new.html.twig', array(
                    'entity' => $entity,
                    'baseentity' => $baseentity,
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
        $baseentity = $this->getBaseEntity($entity->getEntity()->getId());

        $editForm = $this->createForm(new PicType(), $entity);
        
        //Eliminamos la foto del formulario osea que el usuario no podra modificarla.
        // Lo ideal seria....... hacerla NO REQUIRED
        $editForm ->remove('file');
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SimpleCatalogBundle:Pic:edit.html.twig', array(
                    'baseentity' => $baseentity,
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

            $this->container->get('session')->setFlash('alert-success', 'La imágen se ha actualizado correctamente.');
            return $this->redirect($this->generateUrl('pic_edit', array('id' => $id)));
        } else {
            $this->container->get('session')->setFlash('alert-error', 'No se pudo actualizar la imágen.');
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
            $this->container->get('session')->setFlash('alert-success', 'La imágen se eliminó correctamente.');
        } else {
            $this->container->get('session')->setFlash('alert-error', 'No se pudo eliminar la imágen.');
        }
        return $this->redirect($this->generateUrl('pic_gallery', array('id_baseentity' => $entity->getEntity()->getId()) ));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
