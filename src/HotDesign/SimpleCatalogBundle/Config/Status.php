<?php
namespace HotDesign\SimpleCatalogBundle\Entity;

/**
 * Clase estática que se encarga de hacer un manejo estados de los Items
 * 
 */

class Status {
    private $status;
    private $id_default;
    
    
    public function __construct() {
        //Definimos nuestro array de tipos de monedas disponibles
        $this->status = array();
        $status[0] = 'Activo';
        $status[1] = 'Oculto';
        $status[2] = 'Sin Stock';
        $status[3] = 'Entrante';
        
        //Definimos el ID de la currency por default
        $this->id_default = 0;
        
        return $this->status;
        
    }
    
    public function getStatusName($id) {
        if (isset($this->currencies[$id])) {
            return $this->currencies[$id];
        }
        return false;
    }
    
    
    public function getDefaultStatus() {
        return $this->currencies[$this->id_default];
    }
    
};