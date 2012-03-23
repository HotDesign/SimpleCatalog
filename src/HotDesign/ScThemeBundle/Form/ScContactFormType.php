<?php

namespace HotDesign\ScThemeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Description of ScContactFormType
 *
 * @author gbortoli
 */
class ScContactFormType extends AbstractType {
   
    public function buildForm(FormBuilder $builder, array $options) { 
        $builder->add('name', 'text', array('label' => 'Nombre'));
        $builder->add('email', 'email', array('label' => 'E-Mail'));
        $builder->add('description', 'textarea', array('label' => 'Mensaje'));
    }
    
   public function getName() {
       return 'contact_form';
   }
   
}
