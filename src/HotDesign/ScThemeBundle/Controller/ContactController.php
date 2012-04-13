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
use HotDesign\ScThemeBundle\Form\ScContactFormType;

/**
 * ContactController is the controller that will handle the contact forms
 * and them actions
 * 
 * @author    HotDesign info@hotdesign.com.ar
 * @copyright GPL-v2 2012/01/30
 * @package   ScThemeBundle
 * @version   0.1
 * 
 */
class ContactController extends Controller {

    /**
     * Main Contact page display
     * 
     * @return Response A Response instance 
     * 
     */
    public function indexAction() {

        $form = $this->createForm(new ScContactFormType(), array());
        return $this->render('HotDesignScThemeBundle:Contact:index.html.twig', array('form' => $form->createView()));
    }

    public function renderProductContactFormAction($id) {

        $form = $this->createForm(new ScContactFormType(), array('entity_id' => $id));

        return $this->render('HotDesignScThemeBundle:Contact:product_form.html.twig', array('form' => $form->createView()));        
    }

    /**
     * Submit action for the main page contact form.
     * 
     * @return Response A Response instance  
     */
    public function submitContactAction() {
        $request = $this->getRequest();
        $contact_form = $request->get('contact_form');

        $referer = $request->headers->get('referer');      


        $entity_id = FALSE;
        if (isset($contact_form['entity_id'])) {
            $entity_id = (int) $contact_form['entity_id'];
        }

        $form_options = array();
        if ($entity_id) {
            $form_options['entity_id'] = $entity_id;
        }

        $form = $this->createForm(new ScContactFormType(), $form_options);
        
        $form->bindRequest($request);

        if ($form->isValid()) {
            //Todo, get all the contact info and put it to the message body.    
            

            $formulario = array();
            $skip_fields = array(
                '_token',
                'entity_id',
            );

            $entity = FALSE;
            $subject = "Nuevo Mensaje";

            if ($entity_id) {
                $subject = "Nuevo Mensaje de consulta";
                $repo = $this->getDoctrine()->getEntityManager()->getRepository('SimpleCatalogBundle:BaseEntity');
                $entity = $repo->find($entity_id);
            }

            foreach ($contact_form as $k => $field) {

                if (in_array($k, $skip_fields)) {
                    continue;
                }

                $tmp = array();

                $tmp['label'] = $form->get($k)->getAttribute('label');
                $tmp['content'] = $field;
                $formulario[] = $tmp;
            }


            $mail_body = $this->renderView('HotDesignScThemeBundle:Contact/MailTemplates:ContactMail.html.twig', array('fields' => $formulario, 'entity' => $entity )) ;
            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($this->container->getParameter('main_contact_email_from'))
                ->setTo($this->container->getParameter('main_contact_email'))
                ->setBody($mail_body, 'text/html');
                 
            $this->get('mailer')->send($message);
            $this->container->get('session')->setFlash('alert-success', 'Su mensaje ha sido enviado con éxito, muchas gracias.');


            return $this->redirect($referer);
        }

        $this->container->get('session')->setFlash('alert-error', 'Hubo un error al procesar su formulario, intente nuevamente más tarde.');
        return $this->redirect($referer);
    }



}
