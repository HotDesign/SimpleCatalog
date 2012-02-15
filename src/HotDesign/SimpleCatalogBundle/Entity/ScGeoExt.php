<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotDesign\SimpleCatalogBundle\Entity\ScGeoExt
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
     * @ORM\Column(type="decimal", scale="7", nullable=true)
     */
    protected $lat;

    /**
     * @ORM\Column(type="decimal", scale="7", nullable=true)
     */
    protected $lng;

    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean" )
     */
    private $enabled;

    public function __construct() {
        $this->lat = 0;
        $this->lng = 0;
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

}