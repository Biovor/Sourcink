<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isPremium", type="boolean")
     */
    private $isPremium;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category", cascade={"persist"})
     */
    private $products;

    /**
     * @var
     * @ORM\OneToOne(targetEntity="Picture", cascade={"persist"})
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity="Work", mappedBy="category")
     */
    private $works;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Category
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Add product
     *
     * @param Product $product
     *
     * @return Category
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Get picture
     *
     * @return Picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set picture
     *
     * @param Picture $picture
     *
     * @return Category
     */
    public function setPicture(Picture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }


    /**
     * Add work
     *
     * @param \AppBundle\Entity\Work $work
     *
     * @return Category
     */
    public function addWork(\AppBundle\Entity\Work $work)
    {
        $this->works[] = $work;

        return $this;
    }

    /**
     * Remove work
     *
     * @param Work $work
     */
    public function removeWork(\AppBundle\Entity\Work $work)
    {
        $this->works->removeElement($work);
    }

    /**
     * Get works
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorks()
    {
        return $this->works;
    }

    /**
     * Set isPremium
     *
     * @param boolean $isPremium
     *
     * @return Category
     */
    public function setIsPremium($isPremium)
    {
        $this->isPremium = $isPremium;

        return $this;
    }

    /**
     * Get isPremium
     *
     * @return boolean
     */
    public function getIsPremium()
    {
        return $this->isPremium;
    }
}
