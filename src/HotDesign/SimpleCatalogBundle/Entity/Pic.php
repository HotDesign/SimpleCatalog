<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HotDesign\SimpleCatalogBundle\Entity\Pic
 *
 * @ORM\Table(name="vl_pic")
 * @ORM\Entity
 */
class Pic {

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
     * @ORM\Column(name="title", type="string", length=50)
     */
    private $title;

    /**
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var integer $relationship
     *
     * @ORM\ManyToOne(targetEntity="HotDesign\SimpleCatalogBundle\Entity\BaseEntity", inversedBy="pics")
     */
    private $relationship;

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
     * Set path
     *
     * @param string $path
     */
    public function setPath($path) {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Set relationship_id
     *
     * @param VentaLocal\VentaLocalBundle\Entity\BaseEntity $relationshipId
     */
    public function setRelationshipId(\VentaLocal\VentaLocalBundle\Entity\BaseEntity $relationshipId) {
        $this->relationship_id = $relationshipId;
    }

    /**
     * Get relationship_id
     *
     * @return VentaLocal\VentaLocalBundle\Entity\BaseEntity 
     */
    public function getRelationshipId() {
        return $this->relationship_id;
    }

    /**
     * Set relationship
     *
     * @param VentaLocal\VentaLocalBundle\Entity\BaseEntity $relationship
     */
    public function setRelationship(\VentaLocal\VentaLocalBundle\Entity\BaseEntity $relationship) {
        $this->relationship = $relationship;
    }

    /**
     * Get relationship
     *
     * @return VentaLocal\VentaLocalBundle\Entity\BaseEntity 
     */
    public function getRelationship() {
        return $this->relationship;
    }

}