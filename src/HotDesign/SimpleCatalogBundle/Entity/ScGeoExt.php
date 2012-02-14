<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotDesign\SimpleCatalogBundle\Entity\ScGeoExt
 *
 * @ORM\Table(name="scgeoext")
 * @ORM\Entity
 */
class ScGeoExt
{
    /**
     * @var integer $base_entity
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="HotDesign\SimpleCatalogBundle\Entity\BaseEntity")
     */
    private $base_entity;
    
    /**
     * @ORM\Column(type="decimal", scale="7")
     */
    protected $lat;

    /**
     * @ORM\Column(type="decimal", scale="7")
     */
    protected $lng;

 

    /**
     * Set lat
     *
     * @param decimal $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * Get lat
     *
     * @return decimal 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param decimal $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * Get lng
     *
     * @return decimal 
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set base_entity
     *
     * @param HotDesign\SimpleCatalogBundle\Entity\BaseEntity $baseEntity
     */
    public function setBaseEntity(\HotDesign\SimpleCatalogBundle\Entity\BaseEntity $baseEntity)
    {
        $this->base_entity = $baseEntity;
    }

    /**
     * Get base_entity
     *
     * @return HotDesign\SimpleCatalogBundle\Entity\BaseEntity 
     */
    public function getBaseEntity()
    {
        return $this->base_entity;
    }
}