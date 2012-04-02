<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use HotDesign\SimpleCatalogBundle\Config\ItemTypes;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * HotDesign\SimpleCatalogBundle\Entity\Category
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="vl_category")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="HotDesign\SimpleCatalogBundle\Entity\CategoryRepository")
 */
class Category {

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
     * @Assert\NotBlank(message="El título no puede estar en blanco.")
     */
    private $title;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string $tags
     *
     * @ORM\Column(name="tags", type="string", length=255, nullable=true)
     */
    private $tags;

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

    //TREE DOCTRINE EXTENSION
    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    
    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;    
    
    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    private $children;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    public function __toString() {
        return $this->title;
    }

    public function __construct() {

        $this->base_entities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->allowed_pics = 1;
        $this->type = ItemTypes::getIdDefault();
    }

    public function getIndent($symbol = '_') {
        return str_repeat($symbol, $this->getLvl());
    }

    public function setParent(Category $parent) {
        $this->parent = $parent;
    }

    public function getParent() {
        return $this->parent;
    }

    public function getStringType() {
        $type = ItemTypes::getType($this->type);
       
        if (!empty($type['label'])) {
            return $type['label'];
        }
        
        return 'Undefined';
    }
    
    public function getRoot() {
        return $this->root;
    }
    
    
    //Fin Tree extension ....... `
    /**
     * INICIO DE METODOS AUTOGENERADOS  
     * INICIO DE METODOS AUTOGENERADOS  
     * INICIO DE METODOS AUTOGENERADOS  
     */

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
     * Add base_entities
     *
     * @param HotDesign\SimpleCatalogBundle\Entity\BaseEntity $baseEntities
     */
    public function addBaseEntity(\HotDesign\SimpleCatalogBundle\Entity\BaseEntity $baseEntities) {
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

    /**
     * Set lft
     *
     * @param integer $lft
     */
    public function setLft($lft) {
        $this->lft = $lft;
    }

    /**
     * Get lft
     *
     * @return integer 
     */
    public function getLft() {
        return $this->lft;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     */
    public function setRgt($rgt) {
        $this->rgt = $rgt;
    }

    /**
     * Get rgt
     *
     * @return integer 
     */
    public function getRgt() {
        return $this->rgt;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     */
    public function setLvl($lvl) {
        $this->lvl = $lvl;
    }

    /**
     * Get lvl
     *
     * @return integer 
     */
    public function getLvl() {
        return $this->lvl;
    }

    /**
     * Add children
     *
     * @param HotDesign\SimpleCatalogBundle\Entity\Category $children
     */
    public function addCategory(\HotDesign\SimpleCatalogBundle\Entity\Category $children) {
        $this->children[] = $children;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug() {
        return $this->slug;
    }


    /**
     * Set root
     *
     * @param integer $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}