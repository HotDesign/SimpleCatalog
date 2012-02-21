<?php

namespace HotDesign\SimpleCatalogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ScGeoExtType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('lat', 'hidden')
            ->add('lng', 'hidden')
            ->add('enabled', null, array('label' => 'Visible ?', 'required' => false))
        ;
    }

    public function getName()
    {
        return 'hotdesign_simplecatalogbundle_scgeoexttype';
    }
}
