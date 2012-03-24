<?php

namespace HotDesign\ScThemeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
/**
 * Description of ScContactFormType
 *
 * @author gbortoli
 */
class ScContactFormType extends AbstractType {
   
    public function buildForm(FormBuilder $builder, array $options) { 
        $builder->add('name', 'text', array('label' => 'Nombre'));
        $builder->add('email', 'email', array('label' => 'E-Mail'));
        $builder->add('subject', 'text', array('label' => 'Asunto'));
        $builder->add('description', 'textarea', array('label' => 'Mensaje'));
    }
    
        /**
     * @param  array $options
     * @return array
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'validation_constraint' => new Collection(array(
                'name'  => new NotBlank(array(
                    'message' => 'contact_form.name.blank'
                )),
                'email' => array(
                    new NotBlank(array(
                        'message' => 'contact_form.email.blank'
                    )),
                    new Email(array(
                        'message' => 'contact_form.email.invalid'
                    ))
                ),
                
                'subject' => array(),
                
                'description' => new NotBlank(array(
                    'message' => 'contact_form.description.blank'
                )),
            ))
        );
    }
    
   public function getName() {
       return 'contact_form';
   }
   
}
