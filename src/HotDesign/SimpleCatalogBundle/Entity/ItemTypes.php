<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

/**
 * Clase estática que se encarga de hacer un manejo de los tipos de avisos y sus extensiones
 * 
 */
class ItemTypes {
     //Array ( NOMBRE , CLASE EXTENDS )
    private static $types = array(
        0 => array('Rodados', 'Automobiles'),
        1 => array('Rubros', 'BaseEntity'),
        2 => array('Inmuebles', 'Housing'),
        
    );
    private static $id_default = 1;


    public static function getIdDefault() {
        return self::$id_default;
    }
    
    public static function getChoices() {
        $output = array();
        foreach (self::$types as $k => $tipo)
            $output[$k] = $tipo[0];
        return $output;
    }

}

;