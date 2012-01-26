<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotDesign\SimpleCatalogBundle\Entity\Automobiles
 *
 * @ORM\Table(name="vl_automobiles")
 * @ORM\Entity
 */
class Automobiles {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $brand
     *
     * @ORM\Column(name="brand", type="integer")
     */
    private $brand;

    /**
     * @var integer $model
     *
     * @ORM\Column(name="model", type="integer")
     */
    private $model;

    /**
     * @var integer $fuel
     *
     * @ORM\Column(name="fuel", type="integer")
     */
    private $fuel;

    /**
     * @var boolean $used
     *
     * @ORM\Column(name="used", type="boolean")
     */
    private $used;

    /**
     * @var integer $doors_qty
     *
     * @ORM\Column(name="doors_qty", type="integer")
     */
    private $doors_qty;

    /**
     * @var boolean $unique_owner
     *
     * @ORM\Column(name="unique_owner", type="boolean")
     */
    private $unique_owner;

    /**
     * @var string $color
     *
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;

    /**
     * @var integer $km
     *
     * @ORM\Column(name="km", type="integer")
     */
    private $km;

    /**
     * @var integer $motorcc
     *
     * @ORM\Column(name="motorcc", type="integer")
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