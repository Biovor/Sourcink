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
     * @var int
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @return int
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param int $token
     * @return Big5
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="validity", type="integer")
     */
    private $validity;

    /**
     * @var int
     *
     * @ORM\Column(name="extraversion", type="integer")
     */
    private $extraversion;

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
     * @var int
     *
     * @ORM\Column(name="openness", type="integer")
     */
    private $openness;

    /**
     * @var int
     *
     * @ORM\Column(name="neuroticism", type="integer")
     */
    private $neuroticism;

    /**
     * @var int
     *
     * @ORM\Column(name="conscientiouness", type="integer")
     */
    private $conscientiouness;

    /**
     * @var int
     *
     * @ORM\Column(name="agreeableness", type="integer")
     */
    private $agreeableness;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="displayName", type="string", length=255)
     */
    private $displayName;

    /**
     * @var string
     *
     * @ORM\Column(name="iconUrl", type="string", length=255)
     */
    private $iconUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="pdfReport", type="string", length=255)
     */
    private $pdfReport;

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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Big5
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set extraversion
     *
     * @param integer $extraversion
     *
     * @return Big5
     */
    public function setExtraversion($extraversion)
    {
        $this->extraversion = $extraversion;

        return $this;
    }

    /**
     * Get extraversion
     *
     * @return int
     */
    public function getExtraversion()
    {
        return $this->extraversion;
    }

    /**
     * Set openness
     *
     * @param integer $openness
     *
     * @return Big5
     */
    public function setOpenness($openness)
    {
        $this->openness = $openness;

        return $this;
    }

    /**
     * Get openness
     *
     * @return int
     */
    public function getOpenness()
    {
        return $this->openness;
    }

    /**
     * Set neuroticism
     *
     * @param integer $neuroticism
     *
     * @return Big5
     */
    public function setNeuroticism($neuroticism)
    {
        $this->neuroticism = $neuroticism;

        return $this;
    }

    /**
     * Get neuroticism
     *
     * @return int
     */
    public function getNeuroticism()
    {
        return $this->neuroticism;
    }

    /**
     * Set conscientiouness
     *
     * @param integer $conscientiouness
     *
     * @return Big5
     */
    public function setConscientiouness($conscientiouness)
    {
        $this->conscientiouness = $conscientiouness;

        return $this;
    }

    /**
     * Get conscientiouness
     *
     * @return int
     */
    public function getConscientiouness()
    {
        return $this->conscientiouness;
    }

    /**
     * Set agreeableness
     *
     * @param integer $agreeableness
     *
     * @return Big5
     */
    public function setAgreeableness($agreeableness)
    {
        $this->agreeableness = $agreeableness;

        return $this;
    }

    /**
     * Get agreeableness
     *
     * @return int
     */
    public function getAgreeableness()
    {
        return $this->agreeableness;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Big5
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * Set displayName
     *
     * @param string $displayName
     *
     * @return Big5
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set iconUrl
     *
     * @param string $iconUrl
     *
     * @return Big5
     */
    public function setIconUrl($iconUrl)
    {
        $this->iconUrl = $iconUrl;

        return $this;
    }

    /**
     * Get iconUrl
     *
     * @return string
     */
    public function getIconUrl()
    {
        return $this->iconUrl;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Big5
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
     * Set pdfReport
     *
     * @param string $pdfReport
     *
     * @return Big5
     */
    public function setPdfReport($pdfReport)
    {
        $this->pdfReport = $pdfReport;

        return $this;
    }

    /**
     * Get pdfReport
     *
     * @return string
     */
    public function getPdfReport()
    {
        return $this->pdfReport;
    }
}
