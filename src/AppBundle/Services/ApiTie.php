<?php
/**
 * Created by PhpStorm.
 * User: biovor
 * Date: 04/09/17
 * Time: 11:59
 */

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use UserBundle\Entity\User;


/**
 * Class ApiTie
 *
 * @package AppBundle\Services
 */
class ApiTie
{
    private $apiTieUrlInit;
    private $apiTieBig5Key;
    private $apiTieCultureKey;
    private $callback;
    private $userId ;
    private $userMail;


    /**
     * @return mixed
     */
    public function getApiTieUrlInit()
    {
        return $this->apiTieUrlInit;
    }

    /**
     * @param mixed $apiTieUrlInit
     * @return ApiTie
     */
    public function setApiTieUrlInit($apiTieUrlInit)
    {
        $this->apiTieUrlInit = $apiTieUrlInit;
        return $this;
    }

    /**
     * @param mixed $apiTieBig5Key
     * @return ApiTie
     */
    public function setApiTieBig5Key($apiTieBig5Key)
    {
        $this->apiTieBig5Key = $apiTieBig5Key;
        return $this;
    }

    /**
     * @param mixed $callback
     * @return ApiTie
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApiTieBig5Key()
    {
        return $this->apiTieBig5Key;
    }

    /**
     * @return mixed
     */
    public function getApiTieCultureKey()
    {
        return $this->apiTieCultureKey;
    }

    /**
     * @param mixed $apiTieCultureKey
     * @return ApiTie
     */
    public function setApiTieCultureKey($apiTieCultureKey)
    {
        $this->apiTieCultureKey = $apiTieCultureKey;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return ApiTie
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserMail()
    {
        return $this->userMail;
    }

    /**
     * @param mixed $userMail
     * @return ApiTie
     */
    public function setUserMail($userMail)
    {
        $this->userMail = $userMail;
        return $this;
    }



    public function requestBigFive()
    {
       return $request= $this->getApiTieUrlInit().'token='.$this->getApiTieBig5Key().'&callback='.$this->getCallback()
            .'&userId='.$this->getUserId().'&mail='.$this->getUserMail();
    }


}