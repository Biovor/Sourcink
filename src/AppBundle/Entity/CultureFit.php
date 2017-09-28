<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CultureFit
 *
 * @ORM\Table(name="culture_fit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CultureFitRepository")
 */
class CultureFit
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
     * @ORM\Column(name="userId", type="string")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string")
     */
    private $token;

    /**
     * @var int
     *
     * @ORM\Column(name="remuAvt", type="integer", nullable=true)
     */
    private $remuAvt;

    /**
     * @var int
     *
     * @ORM\Column(name="formEvo", type="integer", nullable=true)
     */
    private $formEvo;

    /**
     * @var int
     *
     * @ORM\Column(name="recoMgt", type="integer", nullable=true)
     */
    private $recoMgt;

    /**
     * @var int
     *
     * @ORM\Column(name="exp", type="integer", nullable=true)
     */
    private $exp;

    /**
     * @var int
     *
     * @ORM\Column(name="respCha", type="integer", nullable=true)
     */
    private $respCha;

    /**
     * @var int
     *
     * @ORM\Column(name="devEga", type="integer", nullable=true)
     */
    private $devEga;

    /**
     * @var int
     *
     * @ORM\Column(name="creaInno", type="integer", nullable=true)
     */
    private $creaInno;

    /**
     * @var int
     *
     * @ORM\Column(name="teamAmb", type="integer", nullable=true)
     */
    private $teamAmb;


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
     * @param string $userId
     *
     * @return CultureFit
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return CultureFit
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set remuAvt
     *
     * @param integer $remuAvt
     *
     * @return CultureFit
     */
    public function setRemuAvt($remuAvt)
    {
        $this->remuAvt = $remuAvt;

        return $this;
    }

    /**
     * Get remuAvt
     *
     * @return int
     */
    public function getRemuAvt()
    {
        return $this->remuAvt;
    }

    /**
     * Set formEvo
     *
     * @param integer $formEvo
     *
     * @return CultureFit
     */
    public function setFormEvo($formEvo)
    {
        $this->formEvo = $formEvo;

        return $this;
    }

    /**
     * Get formEvo
     *
     * @return int
     */
    public function getFormEvo()
    {
        return $this->formEvo;
    }

    /**
     * Set recoMgt
     *
     * @param integer $recoMgt
     *
     * @return CultureFit
     */
    public function setRecoMgt($recoMgt)
    {
        $this->recoMgt = $recoMgt;

        return $this;
    }

    /**
     * Get recoMgt
     *
     * @return int
     */
    public function getRecoMgt()
    {
        return $this->recoMgt;
    }

    /**
     * Set exp
     *
     * @param integer $exp
     *
     * @return CultureFit
     */
    public function setExp($exp)
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * Get exp
     *
     * @return int
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * Set respCha
     *
     * @param integer $respCha
     *
     * @return CultureFit
     */
    public function setRespCha($respCha)
    {
        $this->respCha = $respCha;

        return $this;
    }

    /**
     * Get respCha
     *
     * @return int
     */
    public function getRespCha()
    {
        return $this->respCha;
    }

    /**
     * Set devEga
     *
     * @param integer $devEga
     *
     * @return CultureFit
     */
    public function setDevEga($devEga)
    {
        $this->devEga = $devEga;

        return $this;
    }

    /**
     * Get devEga
     *
     * @return int
     */
    public function getDevEga()
    {
        return $this->devEga;
    }

    /**
     * Set creaInno
     *
     * @param integer $creaInno
     *
     * @return CultureFit
     */
    public function setCreaInno($creaInno)
    {
        $this->creaInno = $creaInno;

        return $this;
    }

    /**
     * Get creaInno
     *
     * @return int
     */
    public function getCreaInno()
    {
        return $this->creaInno;
    }

    /**
     * Set teamAmb
     *
     * @param integer $teamAmb
     *
     * @return CultureFit
     */
    public function setTeamAmb($teamAmb)
    {
        $this->teamAmb = $teamAmb;

        return $this;
    }

    /**
     * Get teamAmb
     *
     * @return int
     */
    public function getTeamAmb()
    {
        return $this->teamAmb;
    }
}
