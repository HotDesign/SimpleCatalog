<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

use HotDesign\SimpleCatalogBundle\Config\Currencies;
use HotDesign\SimpleCatalogBundle\Config\ItemTypes;


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
     * 
     * @Assert\NotBlank(message="El titulo no debe estar vacio.")
     * @Assert\MinLength(limit=3, message="El titulo no debe tener menos de 3 caracteres.")
     * @Assert\MaxLength(limit=255, message="El titulo no debe superar los 255 caracteres.")
     */
     
    private $title;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     * 
     *
     * @Assert\NotBlank(message="La descripción no debe estar vacia.")
     * @Assert\MinLength(limit=3, message="La descripción no debe tener menos de 3 caracteres.")
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
     * 
     * @Assert\Min(limit = "0", message = "El precio no debe ser menor a 0")
     * 
     * @Assert\Type(type="float", message="El precio no es válido.")
     */
    private $price;

    /**
     * @var float $price_to_uss
     *
     * @ORM\Column(name="price_to_uss", type="float", nullable=true)
     */
    private $price_to_uss;

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
     * @var text $tags
     *
     * @ORM\Column(name="tags", type="text", nullable=true)
     */
    private $tags;

    /**
     * @var integer $visits
     *
     * @ORM\Column(name="visits", type="integer", nullable=true)
     */
    private $visits;

    /**
     * @var integer $enabled
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var integer $important_general
     *
     * @ORM\Column(name="important_general", type="boolean")
     */
    private $important_general;

    /**
     * @var integer $important_category
     *
     * @ORM\Column(name="important_category", type="boolean")
     */
    private $important_category;

    /**
     * @var string $pics
     *
     * @ORM\OneToMany(targetEntity="HotDesign\SimpleCatalogBundle\Entity\Pic", mappedBy="entity", cascade={"remove"}))
     */
    private $pics;

    /**
     * @var integer $category
     *
     * @ORM\ManyToOne(targetEntity="HotDesign\SimpleCatalogBundle\Entity\Category", inversedBy="base_entities")
     */
    private $category;

    /**
     * @var integer $children_entity_id
     *
     * @ORM\Column(name="children_entity_id", type="integer", nullable=true)
     */
    private $children_entity_id;
    
    
    /**
     * @var $publisher
     *
     * @ORM\ManyToOne(targetEntity="HotDesign\ScUserBundle\Entity\User", inversedBy="items")
     */
    private $publisher;
    
    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;    

    public function __construct() {
        $this->is_billable = true;
        $this->currency = Currencies::getIdDefault();
        $this->visits = 0;
        $this->pics = new \Doctrine\Common\Collections\ArrayCollection();

        $this->enabled = true;
        $this->important_category = false;
        $this->important_general = false;
    }

    public function __toString() {
        return $this->title;
        
    }
    public function getFormattedPrice() {
        if ($this->is_billable && isset($this->currency) && is_numeric($this->price)) {
            return Currencies::getCurrencySymbol($this->currency) . ' ' . $this->price;
        } else {
            return 'Consultar';
        }
    }

    public function get_important_string_detail() {
        $out = '';
        if ($this->important_general) {
            $out .= 'Principal';
        }
        if ($this->important_general && $this->important_category)
            $out .= ' & ';
        if ($this->important_category) {
            $out .= 'Categoría';
        }
        return $out;
    }
    
    public function get_default_pic() {
        $pics = $this->getPics();
        foreach ($pics as $pic) {
            if ($pic->getIsDefault()) {
                return $pic;
            }
        }
        if ($this->getPics()->first())
            return $this->getPics()->first();

        $pic_default = new Pic();
        $pic_default->setTitle('Imágen por defecto');
        $pic_default->setPath('default_item.jpeg');
        return $pic_default;
    }

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
     * Set currency
     *
     * @param integer $currency
     */
    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    /**
     * Get currency
     *
     * @return integer 
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * Set is_billable
     *
     * @param boolean $isBillable
     */
    public function setIsBillable($isBillable) {
        $this->is_billable = $isBillable;
    }

    /**
     * Get is_billable
     *
     * @return boolean 
     */
    public function getIsBillable() {
        return $this->is_billable;
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
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt) {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt() {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt) {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime 
     */
    public function getUpdatedAt() {
        return $this->updated_at;
    }
    /**
     * Set tags
     *
     * @param text $tags
     */
    public function setTags($tags) {
        $this->tags = $tags;
    }

    /**
     * Get tags
     *
     * @return text 
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * Set visits
     *
     * @param integer $visits
     */
    public function setVisits($visits) {
        $this->visits = $visits;
    }

    /**
     * Get visits
     *
     * @return integer 
     */
    public function getVisits() {
        return $this->visits;
    }

    /**
     * Set children_entity_id
     *
     * @param integer $childrenEntityId
     */
    public function setChildrenEntityId($childrenEntityId) {
        $this->children_entity_id = $childrenEntityId;
    }

    /**
     * Get children_entity_id
     *
     * @return integer 
     */
    public function getChildrenEntityId() {
        return $this->children_entity_id;
    }

    /**
     * Add pics
     *
     * @param HotDesign\SimpleCatalogBundle\Entity\Pic $pics
     */
    public function addPic(\HotDesign\SimpleCatalogBundle\Entity\Pic $pics) {
        $this->pics[] = $pics;
    }

    /**
     * Get pics
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPics() {
        return $this->pics;
    }

    /**
     * Add category
     *
     * @param HotDesign\SimpleCatalogBundle\Entity\Category $category
     */
    public function addCategory(\HotDesign\SimpleCatalogBundle\Entity\Category $category) {
        $this->category[] = $category;
    }

    /**
     * Get category
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Set price_to_uss
     *
     * @param float $priceToUss
     */
    public function setPriceToUss($priceToUss) {
        $this->price_to_uss = $priceToUss;
    }

    /**
     * Get price_to_uss
     *
     * @return float 
     */
    public function getPriceToUss() {
        return $this->price_to_uss;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     */
    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled() {
        return $this->enabled;
    }

    /**
     * Set important_general
     *
     * @param boolean $importantGeneral
     */
    public function setImportantGeneral($importantGeneral) {
        $this->important_general = $importantGeneral;
    }

    /**
     * Get important_general
     *
     * @return boolean 
     */
    public function getImportantGeneral() {
        return $this->important_general;
    }

    /**
     * Set important_category
     *
     * @param boolean $importantCategory
     */
    public function setImportantCategory($importantCategory) {
        $this->important_category = $importantCategory;
    }

    /**
     * Get important_category
     *
     * @return boolean 
     */
    public function getImportantCategory() {
        return $this->important_category;
    }


    /**
     * Set category
     *
     * @param HotDesign\SimpleCatalogBundle\Entity\Category $category
     */
    public function setCategory(\HotDesign\SimpleCatalogBundle\Entity\Category $category)
    {
        $this->category = $category;
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
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Set publisher
     *
     * @param HotDesign\ScUserBundle\Entity\User $publisher
     */
    public function setPublisher(\HotDesign\ScUserBundle\Entity\User $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * Get publisher
     *
     * @return HotDesign\ScUserBundle\Entity\User 
     */
    public function getPublisher()
    {
        return $this->publisher;
    }
}