<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

/**
 * Clase estática que se encarga de hacer un manejo de las monedas 
 * 
 */

class Currencies {
    private $currencies;
    private $id_default;
    
    
    public function __construct() {
        //Definimos nuestro array de tipos de monedas disponibles
        $this->currencies = array();
        $currencies[0] = array('Pesos Argentinos', '$AR');
        $currencies[1] = array('Dólares Estadounidences', 'U$S');
        $currencies[2] = array('Euros', '€');
        
        //Definimos el ID de la currency por default
        $this->id_default = 0;
        
    }
    
    public function getCurrencyName($id) {
        if (isset($this->currencies[$id][0])) {
            return $this->currencies[$id][0];
        }
        return false;
    }
    
    
    public function getCurrencySymbol($id) {
        if (isset($this->currencies[$id][1])) {
            return $this->currencies[$id][1];
        }
        return false;
    }
    
    public function getDefaultCurrency() {
        return $this->currencies[$this->id_default];
    }
    
};