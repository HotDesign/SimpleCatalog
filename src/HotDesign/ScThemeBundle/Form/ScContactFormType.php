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
        $builder->add('name', 'text');
        $builder->add('email', 'text');
        $builder->add('description', 'textarea');
    }
    
   public function getName() {
       return 'contact_form';
   }
   
}
