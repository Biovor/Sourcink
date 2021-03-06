<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idCats", type="integer", nullable=true)
     */
    private $idCats;

    /**
     * @return int
     */
    public function getIdCats()
    {
        return $this->idCats;
    }

    /**
     * @param int $idCats
     * @return User
     */
    public function setIdCats($idCats)
    {
        $this->idCats = $idCats;
        return $this;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;


    /**
     * @ORM\Column(name="linkedin_id", type="string", length=255, nullable=true)
     */
    protected $linkedinId;

    /**
     * @var string
     *
     * @ORM\Column(name="wantedJob", type="string", length=255, nullable=true)
     */
    private $wantedJob;

    /**
     * @var integer
     *
     * @ORM\Column(name="experience", type="integer", nullable=true)
     */
    private $experience;

    /**
     * @var string
     *
     * @ORM\Column(name="salary", type="string", nullable=true)
     */
    private $salary;

    /**
     * @var string
     *
     * @ORM\Column(name="wantedSalary", type="string", nullable=true)
     */
    private $wantedSalary;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="resumeName", length=255, type="string", nullable=true)
     */
    private $resumeName;

    /**
     * @var array
     *
     * @ORM\Column(name="mobility", type="array", nullable=true)
     */
    private $mobility;

    /**
     * @var array
     *
     * @ORM\Column(name="mobilityName", type="array", nullable=true)
     */
    private $mobilityName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hasResume", type="boolean", nullable=true)
     */
    private $hasResume;

    /**
     * @var boolean
     *
     * @ORM\Column(name="big5", type="boolean", nullable=true)
     */
    private $big5;

    /**
     * @var integer
     *
     * @ORM\Column(name="sponTime", type="integer", nullable=true)
     */
    private $sponTime;

    /**
     * @return int
     */
    public function getSponTime()
    {
        return $this->sponTime;
    }

    /**
     * @param int $sponTime
     * @return User
     */
    public function setSponTime($sponTime)
    {
        $this->sponTime = $sponTime;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHasResume()
    {
        return $this->hasResume;
    }

    /**
     * @param bool $hasResume
     * @return User
     */
    public function setHasResume($hasResume)
    {
        $this->hasResume = $hasResume;
        return $this;
    }

    /**
     * @return bool
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return array
     */
    public function getMobilityName()
    {
        return $this->mobilityName;
    }

    /**
     * @param array $mobilityName
     * @return User
     */
    public function setMobilityName($mobilityName)
    {
        $this->mobilityName = $mobilityName;
        return $this;
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }

    /**
     * Set linkedinId
     *
     * @param string $linkedinId
     *
     * @return User
     */
    public function setLinkedinId($linkedinId)
    {
        $this->linkedinId = $linkedinId;

        return $this;
    }

    /**
     * Get linkedinId
     *
     * @return string
     */
    public function getLinkedinId()
    {
        return $this->linkedinId;
    }

    /**
     * Set wantedJob
     *
     * @param string $wantedJob
     *
     * @return User
     */
    public function setWantedJob($wantedJob)
    {
        $this->wantedJob = $wantedJob;

        return $this;
    }

    /**
     * Get wantedJob
     *
     * @return string
     */
    public function getWantedJob()
    {
        return $this->wantedJob;
    }

    /**
     * Set experience
     *
     * @param string $experience
     *
     * @return User
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return string
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set salary
     *
     * @param string $salary
     *
     * @return User
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return string
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set wantedSalary
     *
     * @param string $wantedSalary
     *
     * @return User
     */
    public function setWantedSalary($wantedSalary)
    {
        $this->wantedSalary = $wantedSalary;

        return $this;
    }

    /**
     * Get wantedSalary
     *
     * @return string
     */
    public function getWantedSalary()
    {
        return $this->wantedSalary;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return User
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
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set resumeName
     *
     * @param string $resumeName
     *
     * @return User
     */
    public function setResumeName($resumeName)
    {
        $this->resumeName = $resumeName;

        return $this;
    }

    /**
     * Get resumeName
     *
     * @return string
     */
    public function getResumeName()
    {
        return $this->resumeName;
    }

    /**
     * Set mobility
     *
     * @param array $mobility
     *
     * @return User
     */
    public function setMobility($mobility)
    {
        $this->mobility = $mobility;

        return $this;
    }

    /**
     * @return bool
     */
    public function isBig5()
    {
        return $this->big5;
    }

    /**
     * @param bool $big5
     * @return User
     */
    public function setBig5($big5)
    {
        $this->big5 = $big5;
        return $this;
    }

    /**
     * Get mobility
     *
     * @return array
     */
    public function getMobility()
    {
        return $this->mobility;
    }
}
