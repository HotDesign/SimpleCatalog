<?php

namespace HotDesign\ScThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller {

    public function indexAction() {
        return $this->render('HotDesignScThemeBundle:Contact:index.html.twig');
    }

//TODO
    private function sendEmailAction() {
        $message = \Swift_Message::newInstance()
                ->setSubject('Hello Email')
                ->setFrom('alguien@sitio.com')
                ->setTo('destino@gmail.com')
//        ->setBody($this->renderView('HelloBundle:Hello:email.txt.twig', array('name' => $name)))
                ->setBody('Hola')
        ;
        $this->get('mailer')->send($message);

//    return $this->render(...);
        return $this->render('HotDesignScThemeBundle:Contact:index.html.twig');
    }

}
