<?php

namespace HotDesign\SimpleCatalogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use HotDesign\SimpleCatalogBundle\Entity\ItemTypes;
use Doctrine\ORM\EntityRepository;

class CategoryType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options) {


        $builder
                ->add('title', NULL, array('label' => 'Título *'))
                ->add('description', NULL, array('label' => 'Descripción'))
                ->add('tags', NULL, array('label' => 'Etiquetas'))
                ->add('type', 'choice', array(
                    'label' => 'Tipo de Item',
                    'choices' => ItemTypes::getChoices(),
                    'required' => true,
                ))
                ->add('parent', 'entity', array(
                    'label' => 'Dentro de',
                    'required' => false,
                    'class' => 'SimpleCatalogBundle:Category',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->orderBy('u.lft', 'ASC');
                    }
                ))
        ;
    }

    public function getName() {
        return 'hotdesign_simplecatalogbundle_categorytype';
    }

}
