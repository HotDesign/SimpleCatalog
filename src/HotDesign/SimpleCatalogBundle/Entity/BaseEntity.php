<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * HotDesign\SimpleCatalogBundle\Entity\BaseEntity
 *
 * @ORM\Table(name="vl_base_entity")
 * @ORM\Entity
 */
class BaseEntity {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer $currency
     *
     * @ORM\Column(name="currency", type="integer", nullable=true)
     */
    private $currency;

    /**
     * @var boolean $is_billable
     *
     * @ORM\Column(name="is_billable", type="boolean" )
     */
    private $is_billable;

    /**
     * @var float $price
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     * 
     * @Gedmo\Timestampable(on="create")
     */
    private $created_at;

    /**
     * @var datetime $updated_at
     *
     * @ORM\Column(name="updated_at", type="datetime")
     * 
     * @Gedmo\Timestampable(on="update")
     */
    private $updated_at;

    /**
     * @var decimal $lat
     *
     * @ORM\Column(name="lat", type="decimal", nullable=true )
     */
    private $lat;

    /**
     * @var decimal $lng
     *
     * @ORM\Column(name="lng", type="decimal", nullable=true)
     */
    private $lng;

    /**
     * @var text $tags
     *
     * @ORM\Column(name="tags", type="text", nullable=true)
     */
    private $tags;

    /**
     * @var integer $visits
     *
     * @ORM\Column(name="visits", type="integer")
     */
    private $visits;

    /**
     * @var string $pics
     *
     * @ORM\OneToMany(targetEntity="HotDesign\SimpleCatalogBundle\Entity\Pic", mappedBy="relationship_id")
     */
    private $pics;

    /**
     * @var integer $category_id
     *
     * @ORM\OneToMany(targetEntity="HotDesign\SimpleCatalogBundle\Entity\Category", mappedBy="base_entities")
     */
    private $category;

    /**
     * @var integer $status
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var integer $children_entity_id
     *
     * @ORM\Column(name="children_entity_id", type="integer")
     */
    private $children_entity_id;

    public function __construct() {
        $this->pics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children_entity_id = 0;
        
        $currencies = new Currencies();
        
        $this->is_billable = true;
        $this->currency = $currencies->getIdDefault();
        
        $this->visits = 0;
    }


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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set currency
     *
     * @param integer $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * Get currency
     *
     * @return integer 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set is_billable
     *
     * @param boolean $isBillable
     */
    public function setIsBillable($isBillable)
    {
        $this->is_billable = $isBillable;
    }

    /**
     * Get is_billable
     *
     * @return boolean 
     */
    public function getIsBillable()
    {
        return $this->is_billable;
    }

    /**
     * Set price
     *
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

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
     * Set tags
     *
     * @param text $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Get tags
     *
     * @return text 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set visits
     *
     * @param integer $visits
     */
    public function setVisits($visits)
    {
        $this->visits = $visits;
    }

    /**
     * Get visits
     *
     * @return integer 
     */
    public function getVisits()
    {
        return $this->visits;
    }

    /**
     * Set status
     *
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set children_entity_id
     *
     * @param integer $childrenEntityId
     */
    public function setChildrenEntityId($childrenEntityId)
    {
        $this->children_entity_id = $childrenEntityId;
    }

    /**
     * Get children_entity_id
     *
     * @return integer 
     */
    public function getChildrenEntityId()
    {
        return $this->children_entity_id;
    }

    /**
     * Add pics
     *
     * @param HotDesign\SimpleCatalogBundle\Entity\Pic $pics
     */
    public function addPic(\HotDesign\SimpleCatalogBundle\Entity\Pic $pics)
    {
        $this->pics[] = $pics;
    }

    /**
     * Get pics
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPics()
    {
        return $this->pics;
    }

    /**
     * Add category
     *
     * @param HotDesign\SimpleCatalogBundle\Entity\Category $category
     */
    public function addCategory(\HotDesign\SimpleCatalogBundle\Entity\Category $category)
    {
        $this->category[] = $category;
    }

    /**
     * Get category
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCategory()
    {
        return $this->category;
    }
}