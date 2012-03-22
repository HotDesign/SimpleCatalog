<?php

namespace HotDesign\ScHousingExtBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use HotDesign\ScHousingExtBundle\Config\HousingType;

class ScHousingExtType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options) {
        $builder
                ->add('enabled', null, array('label' => 'Habilitado?', 'required' => false))
                ->add('public_address', null, array('label' => 'Dirección Pública'))
                ->add('private_address', null, array('label' => 'Dirección Privada'))
                ->add('housing_type', 'choice', array(
                    'label' => 'Tipo de Operacion',
                    'choices' => HousingType::getChoices(),
                    'required' => false,
                ))
                ->add('nrooms', null, array('label' => 'Cant. de Habitaciones'))
                ->add('nbath', null, array('label' => 'Cant. de Baños'))
                ->add('ngarages', null, array('label' => 'Cant. de Cocheras'))
                ->add('hotwater', null, array('label' => 'Agua Caliente?'))
                ->add('naturalgas', null, array('label' => 'Gas Natural?'))
                ->add('furnished', null, array('label' => 'Amoblado?'))
                ->add('terrain', null, array('label' => 'Medidas del Terreno'))
                ->add('coated_surface', null, array('label' => 'Superficie Cubierta'))
                ->add('youtubelink', null, array('label' => 'Link Youtube'))
        //->add('base_entity')
        ;
    }

    public function getName() {
        return 'hotdesign_schousingextbundle_schousingexttype';
    }

}
