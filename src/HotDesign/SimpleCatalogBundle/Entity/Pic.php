<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

//Validators
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\Image;

//MyConfig
use HotDesign\SimpleCatalogBundle\Config\MyConfig;

/**
 * HotDesign\SimpleCatalogBundle\Entity\Pic
 *
 * @ORM\Table(name="vl_pic")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(name="title", type="string", length=100)
     * @Assert\NotBlank(message="El título no puede estar en blanco.")
     */
    private $title;

    /**
     * @var string $file
     * Validated in $this->loadValidatorMetadata()
     */
    private $file;

    /**
     * @var string $path : "stores the relative path to the file and is persisted to the database."
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @var boolean $is_default
     *
     * @ORM\Column(name="is_default", type="boolean")
     */
    private $is_default;

    /**
     * @var integer $entity
     *
     * @ORM\ManyToOne(targetEntity="HotDesign\SimpleCatalogBundle\Entity\BaseEntity", inversedBy="pics")
     */
    private $entity;

    public function __construct() {
        $this->is_default = false;
    }

    //" is a convenience method that returns the absolute path to the file"
    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    //is a convenience method that returns the web path, which can be used in a template to link to the uploaded file.
    public function getWebPath() {
        return null === $this->path ? null : $this->getUploadDir() . $this->path;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return MyConfig::$image_upload_path;
    }

    public function upload() {
        // the file property can be empty if the field is not required
        if (null === $this->file || $this->file->getClientOriginalName() === null) {
            return;
        }
        //Get de filename and extension of file uploaded.
        $path_parts = pathinfo($this->file->getClientOriginalName());
        $new_name = $path_parts['filename'];
        $extension = '.' . $path_parts['extension']; //Could try catch GuessExtension()
        //Verificaremos si existe el archivo
        $max_iterations = 10;
        $i = 0;
        while (is_file($this->getUploadRootDir() . $new_name . $extension)) {
            $new_name = substr($new_name, 0, 15) . substr(md5(microtime()), 0, 10);
            if ($max_iterations == $i) {
                return; //Exit because max_iterations. No new name could be found.
            }
            $i++;
        }
        $new_name = $new_name . $extension;

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues
        // move takes the target directory and then the target filename to move to
        $this->file->move($this->getUploadRootDir(), $new_name);

        // set the path property to the filename where you'ved saved the file
        $this->path = $new_name;

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($file = $this->getAbsolutePath()) {
            
            unlink($file);
        }
    }

    /*
    * Load a custom validator for Image field (file)
    */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        //* @Assert\Image(maxSize="6000000", mimeTypesMessage="El tipo de archivo no es una imágen.")
        $image = new Image();
        $image->maxSize = MyConfig::$image_max_size_bytes;
        $image->mimeTypesMessage = 'La imágen seleccionada no es de un tipo válido.';

        $metadata->addPropertyConstraint('file', $image );
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
     * Set relationship
     *
     * @param HotDesign\SimpleCatalogBundle\Entity\BaseEntity $relationship
     */
    public function setEntity(\HotDesign\SimpleCatalogBundle\Entity\BaseEntity $relationship) {
        $this->entity = $relationship;
    }

    /**
     * Get relationship
     *
     * @return HotDesign\SimpleCatalogBundle\Entity\BaseEntity 
     */
    public function getEntity() {
        return $this->entity;
    }

    /**
     * Set file
     *
     * @param string $file
     */
    public function setFile($file) {
        $this->file = $file;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile() {
        return $this->file;
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
        return MyConfig::$image_upload_path . $this->path;
    }


    /**
     * Set is_default
     *
     * @param boolean $isDefault
     */
    public function setIsDefault($isDefault)
    {
        $this->is_default = $isDefault;
    }

    /**
     * Get is_default
     *
     * @return boolean 
     */
    public function getIsDefault()
    {
        return $this->is_default;
    }
}