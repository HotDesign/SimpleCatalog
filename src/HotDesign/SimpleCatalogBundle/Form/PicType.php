<?php

namespace HotDesign\SimpleCatalogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PicType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options) {
        $builder
                ->add('title', null, array(
                    'label' => 'Título'
                ))
                ->add('file', null, array(
                    'required' => true,
                    'label' => 'Imágen'
                ))
        // ->add('entity')
        ;
    }

    public function getName() {
        return 'hotdesign_simplecatalogbundle_pictype';
    }

}
