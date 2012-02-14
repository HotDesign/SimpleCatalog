<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotDesign\SimpleCatalogBundle\Entity\Automobiles
 */
class Automobiles
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $brand
     */
    private $brand;

    /**
     * @var integer $model
     */
    private $model;

    /**
     * @var integer $fuel
     */
    private $fuel;

    /**
     * @var boolean $used
     */
    private $used;

    /**
     * @var integer $doors_qty
     */
    private $doors_qty;

    /**
     * @var boolean $unique_owner
     */
    private $unique_owner;

    /**
     * @var string $color
     */
    private $color;

    /**
     * @var integer $km
     */
    private $km;

    /**
     * @var integer $motorcc
     */
    private $motorcc;


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
     * Set brand
     *
     * @param integer $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * Get brand
     *
     * @return integer 
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set model
     *
     * @param integer $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Get model
     *
     * @return integer 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set fuel
     *
     * @param integer $fuel
     */
    public function setFuel($fuel)
    {
        $this->fuel = $fuel;
    }

    /**
     * Get fuel
     *
     * @return integer 
     */
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * Set used
     *
     * @param boolean $used
     */
    public function setUsed($used)
    {
        $this->used = $used;
    }

    /**
     * Get used
     *
     * @return boolean 
     */
    public function getUsed()
    {
        return $this->used;
    }

    /**
     * Set doors_qty
     *
     * @param integer $doorsQty
     */
    public function setDoorsQty($doorsQty)
    {
        $this->doors_qty = $doorsQty;
    }

    /**
     * Get doors_qty
     *
     * @return integer 
     */
    public function getDoorsQty()
    {
        return $this->doors_qty;
    }

    /**
     * Set unique_owner
     *
     * @param boolean $uniqueOwner
     */
    public function setUniqueOwner($uniqueOwner)
    {
        $this->unique_owner = $uniqueOwner;
    }

    /**
     * Get unique_owner
     *
     * @return boolean 
     */
    public function getUniqueOwner()
    {
        return $this->unique_owner;
    }

    /**
     * Set color
     *
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set km
     *
     * @param integer $km
     */
    public function setKm($km)
    {
        $this->km = $km;
    }

    /**
     * Get km
     *
     * @return integer 
     */
    public function getKm()
    {
        return $this->km;
    }

    /**
     * Set motorcc
     *
     * @param integer $motorcc
     */
    public function setMotorcc($motorcc)
    {
        $this->motorcc = $motorcc;
    }

    /**
     * Get motorcc
     *
     * @return integer 
     */
    public function getMotorcc()
    {
        return $this->motorcc;
    }
}