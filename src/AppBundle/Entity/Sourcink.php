<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sourcink
 *
 * @ORM\Table(name="sourcink")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SourcinkRepository")
 */
class Sourcink
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Sourcink
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getText1()
    {
        return $this->text1;
    }

    /**
     * @param string $text1
     * @return Sourcink
     */
    public function setText1($text1)
    {
        $this->text1 = $text1;
        return $this;
    }

    /**
     * @return string
     */
    public function getText2()
    {
        return $this->text2;
    }

    /**
     * @param string $text2
     * @return Sourcink
     */
    public function setText2($text2)
    {
        $this->text2 = $text2;
        return $this;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="text1", type="text")
     */
    private $text1;

    /**
     * @var string
     *
     * @ORM\Column(name="text2", type="text")
     */
    private $text2;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

