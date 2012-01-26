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
     * @ORM\Column(name="currency", type="integer")
     */
    private $currency;

    /**
     * @var float $price
     *
     * @ORM\Column(name="price", type="float")
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
     * @var datetime $published_at
     *
     * @ORM\Column(name="published_at", type="datetime")
     * 
     */
    private $published_at;

    /**
     * @var decimal $lat
     *
     * @ORM\Column(name="lat", type="decimal")
     */
    private $lat;

    /**
     * @var decimal $lng
     *
     * @ORM\Column(name="lng", type="decimal")
     */
    private $lng;

    /**
     * @var text $tags
     *
     * @ORM\Column(name="tags", type="text")
     */
    private $tags;

    /**
     * @var integer $visits
     *
     * @ORM\Column(name="visits", type="integer")
     */
    private $visits;

    /**
     * @var integer $reports
     *
     * @ORM\Column(name="reports", type="integer")
     */
    private $reports;


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
     * Set published_at
     *
     * @param datetime $publishedAt
     */
    public function setPublishedAt($publishedAt) {
        $this->published_at = $publishedAt;
    }

    /**
     * Get published_at
     *
     * @return datetime 
     */
    public function getPublishedAt() {
        return $this->published_at;
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
     * Set reports
     *
     * @param integer $reports
     */
    public function setReports($reports) {
        $this->reports = $reports;
    }

    /**
     * Get reports
     *
     * @return integer 
     */
    public function getReports() {
        return $this->reports;
    }

    /**
     * Set status
     *
     * @param integer $status
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set period
     *
     * @param integer $period
     */
    public function setPeriod($period) {
        $this->period = $period;
    }

    /**
     * Get period
     *
     * @return integer 
     */
    public function getPeriod() {
        return $this->period;
    }

    /**
     * Set in_vl
     *
     * @param boolean $inVl
     */
    public function setInVl($inVl) {
        $this->in_vl = $inVl;
    }

    /**
     * Get in_vl
     *
     * @return boolean 
     */
    public function getInVl() {
        return $this->in_vl;
    }

    /**
     * Set owner
     *
     * @param VentaLocal\UserBundle\Entity\User $owner
     */
    public function setOwner(\VentaLocal\UserBundle\Entity\User $owner) {
        $this->owner = $owner;
    }

    /**
     * Get owner
     *
     * @return VentaLocal\UserBundle\Entity\User 
     */
    public function getOwner() {
        return $this->owner;
    }

    /**
     * Set profile
     *
     * @param VentaLocal\VentaLocalBundle\Entity\Profile $profile
     */
    public function setProfile(\VentaLocal\VentaLocalBundle\Entity\Profile $profile) {
        $this->profile = $profile;
    }

    /**
     * Get profile
     *
     * @return VentaLocal\VentaLocalBundle\Entity\Profile 
     */
    public function getProfile() {
        return $this->profile;
    }

    /**
     * Add pics
     *
     * @param VentaLocal\VentaLocalBundle\Entity\Pic $pics
     */
    public function addPic(\VentaLocal\VentaLocalBundle\Entity\Pic $pics) {
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
     * @param VentaLocal\VentaLocalBundle\Entity\Category $category
     */
    public function addCategory(\VentaLocal\VentaLocalBundle\Entity\Category $category) {
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

}