<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotDesign\SimpleCatalogBundle\Entity\Housing
 *
 * @ORM\Table(name="vl_housing")
 * @ORM\Entity
 */
class Housing {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var integer $bathrooms
     *
     * @ORM\Column(name="bathrooms", type="integer")
     */
    private $bathrooms;

    /**
     * @var integer $rooms
     *
     * @ORM\Column(name="rooms", type="integer")
     */
    private $rooms;

    /**
     * @var string $surface
     *
     * @ORM\Column(name="surface", type="string", length=100)
     */
    private $surface;

    /**
     * @var string $surface_build
     *
     * @ORM\Column(name="surface_build", type="string", length=100)
     */
    private $surface_build;

    /**
     * @var integer $garages
     *
     * @ORM\Column(name="garages", type="integer")
     */
    private $garages;

    /**
     * @var boolean $hot_water
     *
     * @ORM\Column(name="hot_water", type="boolean")
     */
    private $hot_water;

    /**
     * @var boolean $gas
     *
     * @ORM\Column(name="gas", type="boolean")
     */
    private $gas;

    /**
     * @var integer $operation_type
     *
     * @ORM\Column(name="operation_type", type="integer")
     */
    private $operation_type;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set bathrooms
     *
     * @param integer $bathrooms
     */
    public function setBathrooms($bathrooms)
    {
        $this->bathrooms = $bathrooms;
    }

    /**
     * Get bathrooms
     *
     * @return integer 
     */
    public function getBathrooms()
    {
        return $this->bathrooms;
    }

    /**
     * Set rooms
     *
     * @param integer $rooms
     */
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;
    }

    /**
     * Get rooms
     *
     * @return integer 
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Set surface
     *
     * @param string $surface
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;
    }

    /**
     * Get surface
     *
     * @return string 
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Set surface_build
     *
     * @param string $surfaceBuild
     */
    public function setSurfaceBuild($surfaceBuild)
    {
        $this->surface_build = $surfaceBuild;
    }

    /**
     * Get surface_build
     *
     * @return string 
     */
    public function getSurfaceBuild()
    {
        return $this->surface_build;
    }

    /**
     * Set garages
     *
     * @param integer $garages
     */
    public function setGarages($garages)
    {
        $this->garages = $garages;
    }

    /**
     * Get garages
     *
     * @return integer 
     */
    public function getGarages()
    {
        return $this->garages;
    }

    /**
     * Set hot_water
     *
     * @param boolean $hotWater
     */
    public function setHotWater($hotWater)
    {
        $this->hot_water = $hotWater;
    }

    /**
     * Get hot_water
     *
     * @return boolean 
     */
    public function getHotWater()
    {
        return $this->hot_water;
    }

    /**
     * Set gas
     *
     * @param boolean $gas
     */
    public function setGas($gas)
    {
        $this->gas = $gas;
    }

    /**
     * Get gas
     *
     * @return boolean 
     */
    public function getGas()
    {
        return $this->gas;
    }

    /**
     * Set operation_type
     *
     * @param integer $operationType
     */
    public function setOperationType($operationType)
    {
        $this->operation_type = $operationType;
    }

    /**
     * Get operation_type
     *
     * @return integer 
     */
    public function getOperationType()
    {
        return $this->operation_type;
    }
}