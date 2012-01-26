<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

/**
 * Clase estática que se encarga de hacer un manejo de los tipos de avisos y sus extensiones
 * 
 */
class ItemTypes {

    private $types;
    private $id_default;

    public function __construct() {
        $this->types = array();

        //Array ( NOMBRE , CLASE EXTENDS )
        $this->types[0] = array('Rodados', 'Automobiles');
        $this->types[1] = array('Rubros', 'BaseEntity');
        $this->types[2] = array('Inmuebles', 'Housing');

        $this->id_default = 1; //Default Rubros

        return $this->types;
    }

    public function getIdDefault() {
        return $this->id_default;
    }

}

;