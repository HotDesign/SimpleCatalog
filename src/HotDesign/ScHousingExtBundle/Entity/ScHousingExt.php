<?php

namespace HotDesign\ScHousingExtBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use HotDesign\ScHousingExtBundle\Config\HousingType;

/**
 * HotDesign\ScHousingExtBundle\Entity\ScHousingExt
 *
 * @ORM\Table(name="schousingext")
 * @ORM\Entity
 */
class ScHousingExt {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $base_entity
     * @ORM\ManyToOne(targetEntity="HotDesign\SimpleCatalogBundle\Entity\BaseEntity")
     */
    private $base_entity;

    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean" )
     */
    private $enabled;

    /**
     * Set base_entity
     *
     * @param HotDesign\SimpleCatalogBundle\Entity\BaseEntity $baseEntity
     */
    public function setBaseEntity(\HotDesign\SimpleCatalogBundle\Entity\BaseEntity $baseEntity) {
        $this->base_entity = $baseEntity;
    }

    /**
     * Get base_entity
     *
     * @return HotDesign\SimpleCatalogBundle\Entity\BaseEntity 
     */
    public function getBaseEntity() {
        return $this->base_entity;
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

    ## FIN METODOS OBLIGATORIOS
    ## INICIO CUSTOM FIELDS Y METODOS

    /**
     * @var string $public_address
     *
     * @ORM\Column(name="public_address", type="string", length=255,  nullable=true)
     */
    private $public_address;

    /**
     * @var string $private_address
     *
     * @ORM\Column(name="private_address", type="string", length=255,  nullable=true)
     */
    private $private_address;

    /**
     * @var integer $housing_type
     *
     * @ORM\Column(name="housing_type", type="integer", nullable=true)
     */
    private $housing_type;

    /**
     * @var integer $nrooms
     *
     * @ORM\Column(name="nrooms", type="integer", nullable=true)
     */
    private $nrooms;

    /**
     * @var integer $nbath
     *
     * @ORM\Column(name="nbath", type="integer", nullable=true)
     */
    private $nbath;

    /**
     * @var integer $ngarages
     *
     * @ORM\Column(name="ngarages", type="integer", nullable=true)
     */
    private $ngarages;

    /**
     * @var integer $hotwater
     *
     * @ORM\Column(name="hotwater", type="boolean", nullable=true)
     */
    private $hotwater;

    /**
     * @var integer $naturalgas
     *
     * @ORM\Column(name="naturalgas", type="boolean", nullable=true)
     */
    private $naturalgas;

    /**
     * @var integer $furnished
     *
     * @ORM\Column(name="furnished", type="boolean", nullable=true)
     */
    private $furnished;

    /**
     * @var string $terrain
     *
     * @ORM\Column(name="terrain", type="string", length=255,  nullable=true)
     */
    private $terrain;

    /**
     * @var string $coated_surface
     *
     * @ORM\Column(name="coated_surface", type="string", length=255, nullable=true)
     */
    private $coated_surface;

    /**
     * @var string $youtubelink
     *
     * @ORM\Column(name="youtubelink", type="string", length=255,  nullable=true)
     */
    private $youtubelink;

    public function __construct() {
        $this->enabled = false;
    }

    public function __toString() {
        return 'Coordenada #' . $this->id;
    }

    public function getTypeText() {
        if ($this->housing_type)
            return HousingType::getHousingTypeName($this->housing_type);
    }

    /**
     * Set public_address
     *
     * @param string $publicAddress
     */
    public function setPublicAddress($publicAddress) {
        $this->public_address = $publicAddress;
    }

    /**
     * Get public_address
     *
     * @return string 
     */
    public function getPublicAddress() {
        return $this->public_address;
    }

    /**
     * Set private_address
     *
     * @param string $privateAddress
     */
    public function setPrivateAddress($privateAddress) {
        $this->private_address = $privateAddress;
    }

    /**
     * Get private_address
     *
     * @return string 
     */
    public function getPrivateAddress() {
        return $this->private_address;
    }

    /**
     * Set housing_type
     *
     * @param integer $housingType
     */
    public function setHousingType($housingType) {
        $this->housing_type = $housingType;
    }

    /**
     * Get housing_type
     *
     * @return integer 
     */
    public function getHousingType() {
        return $this->housing_type;
    }

    /**
     * Set nrooms
     *
     * @param integer $nrooms
     */
    public function setNrooms($nrooms) {
        $this->nrooms = $nrooms;
    }

    /**
     * Get nrooms
     *
     * @return integer 
     */
    public function getNrooms() {
        return $this->nrooms;
    }

    /**
     * Set nbath
     *
     * @param integer $nbath
     */
    public function setNbath($nbath) {
        $this->nbath = $nbath;
    }

    /**
     * Get nbath
     *
     * @return integer 
     */
    public function getNbath() {
        return $this->nbath;
    }

    /**
     * Set ngarages
     *
     * @param integer $ngarages
     */
    public function setNgarages($ngarages) {
        $this->ngarages = $ngarages;
    }

    /**
     * Get ngarages
     *
     * @return integer 
     */
    public function getNgarages() {
        return $this->ngarages;
    }

    /**
     * Set hotwater
     *
     * @param boolean $hotwater
     */
    public function setHotwater($hotwater) {
        $this->hotwater = $hotwater;
    }

    /**
     * Get hotwater
     *
     * @return boolean 
     */
    public function getHotwater() {
        return $this->hotwater;
    }

    /**
     * Set naturalgas
     *
     * @param boolean $naturalgas
     */
    public function setNaturalgas($naturalgas) {
        $this->naturalgas = $naturalgas;
    }

    /**
     * Get naturalgas
     *
     * @return boolean 
     */
    public function getNaturalgas() {
        return $this->naturalgas;
    }

    /**
     * Set furnished
     *
     * @param boolean $furnished
     */
    public function setFurnished($furnished) {
        $this->furnished = $furnished;
    }

    /**
     * Get furnished
     *
     * @return boolean 
     */
    public function getFurnished() {
        return $this->furnished;
    }

    /**
     * Set terrain
     *
     * @param string $terrain
     */
    public function setTerrain($terrain) {
        $this->terrain = $terrain;
    }

    /**
     * Get terrain
     *
     * @return string 
     */
    public function getTerrain() {
        return $this->terrain;
    }

    /**
     * Set coated_surface
     *
     * @param string $coatedSurface
     */
    public function setCoatedSurface($coatedSurface) {
        $this->coated_surface = $coatedSurface;
    }

    /**
     * Get coated_surface
     *
     * @return string 
     */
    public function getCoatedSurface() {
        return $this->coated_surface;
    }

    /**
     * Set youtubelink
     *
     * @param string $youtubelink
     */
    public function setYoutubelink($youtubelink) {
        $this->youtubelink = $youtubelink;
    }

    /**
     * Get youtubelink
     *
     * @return string 
     */
    public function getYoutubelink() {
        return $this->youtubelink;
    }

}