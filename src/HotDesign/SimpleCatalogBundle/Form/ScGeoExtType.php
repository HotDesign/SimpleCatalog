<?php

namespace HotDesign\SimpleCatalogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use HotDesign\SimpleCatalogBundle\Entity\Currencies;

class BaseEntityType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options) {
        $builder
                ->add('lat')
                ->add('lng')
                ;
    }

    public function getName() {
        return 'hotdesign_simplecatalogbundle_baseentitytype';
    }

}
