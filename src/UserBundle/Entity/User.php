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


    /** @ORM\Column(name="linkedin_id", type="string", length=255, nullable=true)
     */
    protected $linkedinId;

    /**
     * @var string
     *
     * @ORM\Column(name="currentJob", type="string", length=255, nullable=true)
     */
    private $currentJob;

    /**
     * @var string
     *
     * @ORM\Column(name="wantedJob", type="string", length=255, nullable=true)
     */
    private $wantedJob;

    /**
     * @var string
     *
     * @ORM\Column(name="mobility", type="string", length=255, nullable=true)
     */
    private $mobility;

    /**
     * @var string
     *
     * @ORM\Column(name="experience", type="string", length=255, nullable=true)
     */
    private $experience;

    /**
     * @var string
     *
     * @ORM\Column(name="salary", type="string", length=255, nullable=true)
     */
    private $salary;

    /**
     * @var string
     *
     * @ORM\Column(name="wantedSalary", type="string", length=255, nullable=true)
     */
    private $wantedSalary;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;



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
<
     * Set linkedinId
     *
     * @param string $linkedinId
     *
     * @return User
     */
    public function setLinkedinId($linkedinId)
    {
        $this->linkedin_id = $linkedinId;
        return $this;
    }
    /**
     * Get linkedinId
     *
     * @return string
     */
    public function getLinkedinId()
    {
        return $this->linkedin_id;

     * Set currentJob
     *
     * @param string $currentJob
     *
     * @return User
     */
    public function setCurrentJob($currentJob)
    {
        $this->currentJob = $currentJob;

        return $this;
    }

    /**
     * Get currentJob
     *
     * @return string
     */
    public function getCurrentJob()
    {
        return $this->currentJob;
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
     * Get mobility
     *
     * @return array
     */
    public function getMobility()
    {
        return $this->mobility;
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
}
