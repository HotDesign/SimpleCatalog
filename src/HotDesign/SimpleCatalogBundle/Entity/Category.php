<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotDesign\SimpleCatalogBundle\Entity\Category
 *
 * @ORM\Table(name="vl_category")
 * @ORM\Entity
 */
class Category {
    
    
    public $types = array(
        '1' => 'No extiende',
        '2' => 'Rodados',
        '3' => 'Inmuebles',
    );

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
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string $tags
     *
     * @ORM\Column(name="tags", type="string", length=255)
     */
    private $tags;

    /**
     * @var integer $ordercat
     *
     * @ORM\Column(name="ordercat", type="integer")
     */
    private $ordercat;
    
    /**
     * @var array $base_entities
     *
     * @ORM\OneToMany(targetEntity="HotDesign\SimpleCatalogBundle\Entity\BaseEntity", mappedBy="category")
     */
    private $base_entities;

    /**
     * @var integer $type
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var integer $allowed_pics
     *
     * @ORM\Column(name="allowed_pics", type="integer")
     */
    private $allowed_pics;


    public function __construct() {
        $this->base_entities = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     */
    public function setPrice($price) {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set tags
     *
     * @param string $tags
     */
    public function setTags($tags) {
        $this->tags = $tags;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * Set ordercat
     *
     * @param integer $ordercat
     */
    public function setOrdercat($ordercat) {
        $this->ordercat = $ordercat;
    }

    /**
     * Get ordercat
     *
     * @return integer 
     */
    public function getOrdercat() {
        return $this->ordercat;
    }

    /**
     * Set type
     *
     * @param integer $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set allowed_pics
     *
     * @param integer $allowedPics
     */
    public function setAllowedPics($allowedPics) {
        $this->allowed_pics = $allowedPics;
    }

    /**
     * Get allowed_pics
     *
     * @return integer 
     */
    public function getAllowedPics() {
        return $this->allowed_pics;
    }

    /**
     * Set twitter_username
     *
     * @param string $twitterUsername
     */
    public function setTwitterUsername($twitterUsername) {
        $this->twitter_username = $twitterUsername;
    }

    /**
     * Get twitter_username
     *
     * @return string 
     */
    public function getTwitterUsername() {
        return $this->twitter_username;
    }

    /**
     * Set group
     *
     * @param VentaLocal\VentaLocalBundle\Entity\Groups $group
     */
    public function setGroup(\VentaLocal\VentaLocalBundle\Entity\Groups $group) {
        $this->group = $group;
    }

    /**
     * Get group
     *
     * @return VentaLocal\VentaLocalBundle\Entity\Groups 
     */
    public function getGroup() {
        return $this->group;
    }

    /**
     * Add base_entities
     *
     * @param VentaLocal\VentaLocalBundle\Entity\BaseEntity $baseEntities
     */
    public function addBaseEntity(\VentaLocal\VentaLocalBundle\Entity\BaseEntity $baseEntities) {
        $this->base_entities[] = $baseEntities;
    }

    /**
     * Get base_entities
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getBaseEntities() {
        return $this->base_entities;
    }

}