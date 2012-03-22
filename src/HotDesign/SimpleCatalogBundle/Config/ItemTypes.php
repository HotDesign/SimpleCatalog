<?php

namespace HotDesign\SimpleCatalogBundle\Config;

/**
 * Clase estática que se encarga de hacer un manejo de los tipos de avisos y sus extensiones
 * 
 */
class ItemTypes {

    const AUTOMOBILES = 0;
    const BASE = 1;
    const HOUSING = 2;

    //Listado de todas las extensiones posibles.
    public static $sc_extensions = array(
        'ScGeoExt' => array(
            'bundle_name' => 'ScGeoExtBundle',
            'entity' => 'HotDesign\ScGeoExtBundle\Entity\ScGeoExt',
            'class'   => 'ScGeoExt',
        ),
        'ScHousingExt' => array(
            'bundle_name' => 'ScHousingExtBundle',
            'entity' => 'HotDesign\ScHousingExtBundle\Entity\ScHousingExt',
            'class'   => 'ScHousingExt',
        ),
    );
    //Array ( NOMBRE , CLASE EXTENDS )
    private static $types = array(
        self::AUTOMOBILES => array(
            'label' => 'Rodados',
            'class_extends' => array('ScGeoExt')
        ),
        self::BASE => array(
            'label' => 'Items',
            'class_extends' => array('ScGeoExt')
        ),
        self::HOUSING => array(
            'label' => 'Inmuebles',
            'class_extends' => array('ScGeoExt', 'ScHousingExt')
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
        if (!isset(self::$types[$id])) {
            echo 'El tipo ' . $id . ' no está definido en ItemTypes.php';
            exit();
        }
        
        $extensiones = array();
        //Control de configuracion de la extension
        foreach (self::$types[$id]['class_extends'] as $extension) {
            if (!empty($extension) && !isset(self::$sc_extensions[$extension])) {
                echo 'La extension ' . $extension . ' no fue configurada en el arreglo sc_extensions.';
                exit();
            }
            $extensiones[$extension] =  self::$sc_extensions[$extension];
        }
        return $extensiones;
    }
    
    public static function getType($id) {
        if (isset(self::$types[$id]))
            return self::$types[$id];
        return false;
    }
};