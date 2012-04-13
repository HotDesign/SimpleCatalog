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
        $builder->add('description', 'textarea', array('label' => 'Mensaje', 'attr' => array('rows' => '10', 'cols' => 20),));

        $entity_id = FALSE;
        if (array_key_exists('data', $options)) {
             if (array_key_exists('entity_id', $options['data'])) { 
             $entity_id = (int) $options['data']['entity_id'];
         }
        }

        $builder->add('entity_id', 'hidden', array('data' => $entity_id));
        
        
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
                    'message' => 'El campo nombre no debe estar vacío.'
                )),
                'email' => array(
                    new NotBlank(array(
                        'message' => 'El campo de email no debe estar vacio.'
                    )),
                    new Email(array(
                        'message' => 'El email debe tener un formato valido, ejemplo nombre@email.com'
                    ))
                ),
                
                'subject' => array(),
                'entity_id' => array(),
                
                'description' => new NotBlank(array(
                    'message' => 'Debe escribir un mensaje para continuar.'
                )),
            ))
        );
    }
    
   public function getName() {
       return 'contact_form';
   }
   
}
