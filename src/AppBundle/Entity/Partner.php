<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Annotations\AnnotationException;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Partner
 *
 * @ORM\Table(name="partner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartnerRepository")
 */
class Partner
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
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var
     *
     * @ORM\OneToOne(targetEntity="Picture", cascade={"persist"})
     *
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="partnerName", type="string", length=255)
     */
    private $partnerName;


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
     * Set path
     *
     * @param string $path
     *
     * @return Partner
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set partnerName
     *
     * @param string $partnerName
     *
     * @return Partner
     */
    public function setPartnerName($partnerName)
    {
        $this->partnerName = $partnerName;

        return $this;
    }

    /**
     * Get partnerName
     *
     * @return string
     */
    public function getPartnerName()
    {
        return $this->partnerName;
    }

    /**
     * Set picture
     *
     * @param Picture $picture
     *
     * @return Partner
     */
    public function setPicture(Picture $picture = null)
    {
        $this->picture = $picture;

        return $this;
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

}


