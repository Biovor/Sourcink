<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Big5
 *
 * @ORM\Table(name="big5")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Big5Repository")
 */
class Big5
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
     * @ORM\Column(name="userId", type="string", length=255)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @var int
     *
     * @ORM\Column(name="validity", type="integer", nullable=true)
     */
    private $validity;

    /**
     * @var int
     *
     * @ORM\Column(name="extraversion", type="integer", nullable=true)
     */
    private $extraversion;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Big5
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @return Big5
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Big5
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return int
     */
    public function getValidity()
    {
        return $this->validity;
    }

    /**
     * @param int $validity
     * @return Big5
     */
    public function setValidity($validity)
    {
        $this->validity = $validity;
        return $this;
    }

    /**
     * @return int
     */
    public function getExtraversion()
    {
        return $this->extraversion;
    }

    /**
     * @param int $extraversion
     * @return Big5
     */
    public function setExtraversion($extraversion)
    {
        $this->extraversion = $extraversion;
        return $this;
    }

    /**
     * @return int
     */
    public function getOpenness()
    {
        return $this->openness;
    }

    /**
     * @param int $openness
     * @return Big5
     */
    public function setOpenness($openness)
    {
        $this->openness = $openness;
        return $this;
    }

    /**
     * @return int
     */
    public function getNeuroticism()
    {
        return $this->neuroticism;
    }

    /**
     * @param int $neuroticism
     * @return Big5
     */
    public function setNeuroticism($neuroticism)
    {
        $this->neuroticism = $neuroticism;
        return $this;
    }

    /**
     * @return int
     */
    public function getConscientiouness()
    {
        return $this->conscientiouness;
    }

    /**
     * @param int $conscientiouness
     * @return Big5
     */
    public function setConscientiouness($conscientiouness)
    {
        $this->conscientiouness = $conscientiouness;
        return $this;
    }

    /**
     * @return int
     */
    public function getAgreeableness()
    {
        return $this->agreeableness;
    }

    /**
     * @param int $agreeableness
     * @return Big5
     */
    public function setAgreeableness($agreeableness)
    {
        $this->agreeableness = $agreeableness;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Big5
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     * @return Big5
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @return string
     */
    public function getIconUrl()
    {
        return $this->iconUrl;
    }

    /**
     * @param string $iconUrl
     * @return Big5
     */
    public function setIconUrl($iconUrl)
    {
        $this->iconUrl = $iconUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Big5
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getPdfReport()
    {
        return $this->pdfReport;
    }

    /**
     * @param string $pdfReport
     * @return Big5
     */
    public function setPdfReport($pdfReport)
    {
        $this->pdfReport = $pdfReport;
        return $this;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="openness", type="integer", nullable=true)
     */
    private $openness;

    /**
     * @var int
     *
     * @ORM\Column(name="neuroticism", type="integer", nullable=true)
     */
    private $neuroticism;

    /**
     * @var int
     *
     * @ORM\Column(name="conscientiouness", type="integer", nullable=true)
     */
    private $conscientiouness;

    /**
     * @var int
     *
     * @ORM\Column(name="agreeableness", type="integer", nullable=true)
     */
    private $agreeableness;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="displayName", type="string", length=255, nullable=true)
     */
    private $displayName;

    /**
     * @var string
     *
     * @ORM\Column(name="iconUrl", type="string", length=255, nullable=true)
     */
    private $iconUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="pdfReport", type="string", length=255, nullable=true)
     */
    private $pdfReport;

}