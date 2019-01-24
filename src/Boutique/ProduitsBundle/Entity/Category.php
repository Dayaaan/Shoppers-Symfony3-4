<?php

namespace Boutique\ProduitsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="Boutique\ProduitsBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /** 
     * @ORM\OneToOne(targetEntity="ImagePrincipale", cascade={"persist", "remove"})
     */
    private $imagePrincipale;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    public function __toString() {
        return $this->name;
    }

    /**
     * Set imagePrincipale
     *
     * @param \Boutique\ProduitsBundle\Entity\ImagePrincipale $imagePrincipale
     *
     * @return Category
     */
    public function setImagePrincipale(\Boutique\ProduitsBundle\Entity\ImagePrincipale $imagePrincipale = null)
    {
        $this->imagePrincipale = $imagePrincipale;

        return $this;
    }

    /**
     * Get imagePrincipale
     *
     * @return \Boutique\ProduitsBundle\Entity\ImagePrincipale
     */
    public function getImagePrincipale()
    {
        return $this->imagePrincipale;
    }
}
