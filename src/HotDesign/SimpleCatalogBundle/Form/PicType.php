<?php

namespace HotDesign\SimpleCatalogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PicType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('file')
           // ->add('entity')
        ;
    }

    public function getName()
    {
        return 'hotdesign_simplecatalogbundle_pictype';
    }
}
