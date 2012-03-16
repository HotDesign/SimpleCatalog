<?php

namespace HotDesign\ScGeoExtBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use HotDesign\SimpleCatalogBundle\Config\MyConfig;

/**
 * HotDesign\ScGeoExtBundle\Entity\ScGeoExt
 *
 * @ORM\Table(name="scgeoext")
 * @ORM\Entity
 */
class ScGeoExt {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $base_entity
     * @ORM\ManyToOne(targetEntity="HotDesign\SimpleCatalogBundle\Entity\BaseEntity")
     */
    private $base_entity;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $lat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $lng;

    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean" )
     */
    private $enabled;

    public function __construct() {
        $this->lat = MyConfig::$default_lat;
        $this->lng = MyConfig::$default_lng;
        $this->enabled = false;
    }

    public function __toString() {
        return 'Coordenada #' . $this->id;
    }
    /**
     * Set lat
     *
     * @param decimal $lat
     */
    public function setLat($lat) {
        $this->lat = $lat;
    }

    /**
     * Get lat
     *
     * @return decimal 
     */
    public function getLat() {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param decimal $lng
     */
    public function setLng($lng) {
        $this->lng = $lng;
    }

    /**
     * Get lng
     *
     * @return decimal 
     */
    public function getLng() {
        return $this->lng;
    }

    /**
     * Set base_entity
     *
     * @param HotDesign\SimpleCatalogBundle\Entity\BaseEntity $baseEntity
     */
    public function setBaseEntity(\HotDesign\SimpleCatalogBundle\Entity\BaseEntity $baseEntity) {
        $this->base_entity = $baseEntity;
    }

    /**
     * Get base_entity
     *
     * @return HotDesign\SimpleCatalogBundle\Entity\BaseEntity 
     */
    public function getBaseEntity() {
        return $this->base_entity;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set enabled
     *
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}