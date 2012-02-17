<?php

namespace HotDesign\SimpleCatalogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use HotDesign\SimpleCatalogBundle\Config\Currencies;

class BaseEntityType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options) {
        $builder
                ->add('category', null, array('label' => 'Categoría'))
                ->add('title', null, array('label' => 'Título'))
                ->add('description', null, array('label' => 'Descripción'))
                ->add('is_billable', null, array('label' => 'Mostrar Precio?', 'required' => false))
                ->add('currency', 'choice', array(
                    'label' => 'Moneda',
                    'choices' => Currencies::getChoices(),
                    'required' => false,
                ))
                ->add('price', null, array('label' => 'Precio', 'required' => false))
                // ->add('price_to_uss')
                // ->add('created_at')
                // ->add('updated_at')
              //  ->add('lat', null, array('label' => 'Latitud GPS'))
                //->add('lng', null, array('label' => 'Longitud GPS'))
                ->add('tags')
                //->add('visits')
                ->add('enabled', null, array('label' => 'Habilitado?' , 'required' => false))
                ->add('important_general', null, array('label' => 'Destacado en Principal?', 'required' => false))
                ->add('important_category', null, array('label' => 'Destacado en Categoría?', 'required' => false))
        //->add('children_entity_id')
        ;
    }

    public function getName() {
        return 'hotdesign_simplecatalogbundle_baseentitytype';
    }

}
