<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

/**
 * Clase estática que se encarga de hacer un manejo de los tipos de avisos y sus extensiones
 * 
 */
class ItemTypes {
    
     const AUTOMOBILES =  0;
     const BASE =  1;
     const HOUSING =  2;
    
    
     //Array ( NOMBRE , CLASE EXTENDS )
    private static $types = array(
        self::AUTOMOBILES => array(
            'label' => 'Rodados',
            'class_extends' => array('ScAutomobilesExt')
            ),
        self::BASE => array(
            'label' => 'Items',
            'class_extends' => array('')
            ),
        self::HOUSING => array(
            'label' => 'Inmuebles',
            'class_extends' => array( 'ScGeoExt'  )
            ),
        
    );
    private static $id_default = 1;


    public static function getIdDefault() {
        return self::$id_default;
    }
    
    public static function getChoices() {
        $output = array();
        foreach (self::$types as $k => $tipo)
            $output[$k] = $tipo['label'];
        return $output;
    }
    
    public static function getClassExtends($id) {
        return self::$types[$id]['class_extends'];
    }

};