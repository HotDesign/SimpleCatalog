<?php

namespace HotDesign\SimpleCatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HotDesign\SimpleCatalogBundle\Entity\Category;
use HotDesign\SimpleCatalogBundle\Form\CategoryType;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller {

    /**
     * Lists all Category entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

$repo = $em->getRepository('SimpleCatalogBundle:Category');

$self = $this;
$options = array(
    'decorate' => true,
    'rootOpen' => '<ul class="nestedCategories">',
    'rootClose' => '</ul>',
    'childOpen' => '<li>',
    'childClose' => '</li>',
    'nodeDecorator' => function($node) use ($self) {
        $url =  $self->get('router')->generate('category_edit', array('id' => $node['id']));
        
        $html = '';
        $html .= '<p>';
        $html .= '<a href="'.$url.'">'.$node['title'].'</a>';
        $html .= '<blockquote>' .substr($node['description'], 0, 140). '</blockquote>';
        $html .= '</p>';
        
        return $html;
    }
);
$htmlTree = $repo->childrenHierarchy(
    null, /* starting from root nodes */
    false, /* load all children, not only direct */
    $options
);

        
        return $this->render('SimpleCatalogBundle:Category:index.html.twig', array(
                    'html_tree' => $htmlTree
                ));
    }

    /**
     * Displays a form to create a new Category entity.
     *
     */
    public function newAction() {
        $entity = new Category();
        $form = $this->createForm(new CategoryType(), $entity);

        return $this->render('SimpleCatalogBundle:Category:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                ));
    }

    /**
     * Creates a new Category entity.
     *
     */
    public function createAction() {
        $entity = new Category();
        $request = $this->getRequest();
        $form = $this->createForm(new CategoryType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $this->container->get('session')->setFlash('alert-success', 'La categoría se ha creado con éxito.');
            return $this->redirect($this->generateUrl('category_edit', array('id' => $entity->getId())));
        }

        return $this->render('SimpleCatalogBundle:Category:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                ));
    }

    /**
     * Displays a form to edit an existing Category entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SimpleCatalogBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $editForm = $this->createForm(new CategoryType(), $entity);
        
        //If is the parent entity, hide the parent feature.
        if ($entity->getId() == 1) {
            $editForm->remove ('parent');
        }
        
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SimpleCatalogBundle:Category:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Edits an existing Category entity.
     *
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SimpleCatalogBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $editForm = $this->createForm(new CategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid() ) {
            $em->persist($entity);
            $em->flush();

            $this->container->get('session')->setFlash('alert-success', 'La categoría se ha modificado con éxito.');
            return $this->redirect($this->generateUrl('category_edit', array('id' => $id)));
        } else {
            $this->container->get('session')->setFlash('alert-error', 'No se pudo modificar la categoría.');
        }

        return $this->render('SimpleCatalogBundle:Category:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Deletes a Category entity.
     *
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('SimpleCatalogBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        if ($form->isValid() && $this->isDeletable($entity)) {
            $em->remove($entity);
            $em->flush();
            $this->container->get('session')->setFlash('alert-success', 'La categoría se ha eliminado con éxito.');
            return $this->redirect($this->generateUrl('category'));
        }
        return $this->redirect($this->generateUrl('category_edit', array('id' => $id ) ));

    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    public function isDeletable(Category $categoria) {
        $nproductos = count($categoria->getBaseEntities());
        if ($nproductos == 0) {
            return true;
        } 
        $this->container->get('session')->setFlash('alert-error', 'La categoría no pudo ser eliminada debido a que contiene Items asignados. Mueva o elimine estos Items para poder eliminarla. ');
        return false;        
    }

}
