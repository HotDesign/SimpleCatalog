<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

/**
 * Clase estática que se encarga de hacer un manejo de las monedas 
 * 
 */
class Currencies {
    const PESO_AR = 0;
    const DOLAR = 1;
    const EURO = 2;

    //Arreglo de monedas Disponibles....
    //
    // array(NOMBRE_MONEDA, SIMBOLO, INDICE PARA LLEVAR A DOLAR)

    private static $currencies = array(
        self::PESO_AR => array(
            'label' => 'Pesos Argentinos',
            'symbol' => '$AR', 
            'index' =>4.31
        ),
        
        self::DOLAR => array(
            'label' => 'Dólares Estadounidences',
            'symbol' => 'U$S',
            'index' => 1 
        ),
        
        self::EURO => array(
            'label' => 'Euros',
            'symbol' =>'€',
            'index' => 2.1
       ),
    );
    private static $id_default = self::PESO_AR;

    public static function getCurrencyName($id) {
        if (isset($this->currencies[$id]['label'])) {
            return $this->currencies[$id]['label'];
        }
        return false;
    }

    public static function getCurrencySymbol($id) {
        if (isset($this->currencies[$id]['symbol'])) {
            return $this->currencies[$id]['symbol'];
        }
        return false;
    }

    public static function getCurrencyIndex($id) {
        if (isset($this->currencies[$id]['index'])) {
            return $this->currencies[$id]['index'];
        }
        return false;
    }

    public function getDefaultCurrency() {
        return $this->currencies[self::id_default];
    }

    public function getIdDefault() {
        return self::id_default;
    }

}

;