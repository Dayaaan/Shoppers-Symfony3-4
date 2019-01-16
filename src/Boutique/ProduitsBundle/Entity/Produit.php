<?php

namespace Boutique\ProduitsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Boutique\ProduitsBundle\Entity\Category;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="Boutique\ProduitsBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToMany(targetEntity="Category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /** 
     * @ORM\OneToOne(targetEntity="ImagePrincipale", cascade={"persist", "remove"})
     */
    private $imagePrincipale;
    
    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="produit", cascade={"persist","remove"})
     */
    private $images;


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
     * @return Produit
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
     * @return Produit
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

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Produit
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Produit
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add category
     *
     * @param \Boutique\ProduitsBundle\Entity\Category $category
     *
     * @return Produit
     */
    public function addCategory(\Boutique\ProduitsBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Boutique\ProduitsBundle\Entity\Category $category
     */
    public function removeCategory(\Boutique\ProduitsBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set imagePrincipale
     *
     * @param \Boutique\ProduitsBundle\Entity\ImagePrincipale $imagePrincipale
     *
     * @return Produit
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

    /**
     * Add image
     *
     * @param \Boutique\ProduitsBundle\Entity\Image $image
     *
     * @return Produit
     */
    public function addImage(\Boutique\ProduitsBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \Boutique\ProduitsBundle\Entity\Image $image
     */
    public function removeImage(\Boutique\ProduitsBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    public function __toString() {
        return $this->name;
    }
}
