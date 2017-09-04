<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PartnerView
 *
 * @ORM\Table(name="partner_view")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartnerViewRepository")
 */
class PartnerView
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
     * @var int
     *
     * @ORM\Column(name="s", type="integer")
     */
    private $s;

    /**
     * @var int
     *
     * @ORM\Column(name="m", type="integer")
     */
    private $m;

    /**
     * @var int
     *
     * @ORM\Column(name="l", type="integer")
     */
    private $l;


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
     * Set s
     *
     * @param integer $s
     *
     * @return PartnerView
     */
    public function setS($s)
    {
        $this->s = $s;

        return $this;
    }

    /**
     * Get s
     *
     * @return int
     */
    public function getS()
    {
        return $this->s;
    }

    /**
     * Set m
     *
     * @param integer $m
     *
     * @return PartnerView
     */
    public function setM($m)
    {
        $this->m = $m;

        return $this;
    }

    /**
     * Get m
     *
     * @return int
     */
    public function getM()
    {
        return $this->m;
    }

    /**
     * Set l
     *
     * @param string $l
     *
     * @return PartnerView
     */
    public function setL($l)
    {
        $this->l = $l;

        return $this;
    }

    /**
     * Get l
     *
     * @return string
     */
    public function getL()
    {
        return $this->l;
    }
}
