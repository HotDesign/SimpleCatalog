<?php

namespace HotDesign\ScHousingExtBundle\Config;

/**
 * Clase estática que se encarga de hacer un manejo de los tipos de operaciones
 * 
 */
class HousingType {

    private static $types = array(
        '0' => array(
            'label' => 'Venta',
        ),
        '1' => array(
            'label' => 'Alquiler',
        ),
        '2' => array(
            'label' => 'Venta/Alquiler',
        ),
        '3' => array(
            'label' => 'Alquilada',
        ),
        '4' => array(
            'label' => 'Vendida',
        ),
        '5' => array(
            'label' => 'A confirmar',
        ),
        '6' => array(
            'label' => 'Proyecto',
        ),
        '7' => array(
            'label' => 'En construcción',
        ),
        '8' => array(
            'label' => 'Finalizada',
        ),
    );
    private static $id_default = 5;

    public static function getChoices() {
        $output = array();
        foreach (self::$types as $k => $curr)
            $output[$k] = $curr['label'];
        return $output;
    }

    public static function getHousingTypeName($id) {
        if (isset(self::$types[$id]['label'])) {
            return self::$types[$id]['label'];
        }
        return false;
    }

    public static function getDefaultHousingType() {
        return self::$types[self::id_default];
    }

    public static function getIdDefault() {
        return self::$id_default;
    }

}

;