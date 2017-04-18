<?php
/**
 * Created by PhpStorm.
 * User: mathieuferreira
 * Date: 16/04/17
 * Time: 15:15
 */

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class User {

    #region Const
    #endregion
    
    #region Public Properties
    #endregion
    
    #region Protected Properties

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $userId;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $firstName;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $lastName;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $email;

    #endregion
    
    #region Private Properties
    #endregion
    
    #region Magic methods
    #endregion
    
    #region Getters/Setters

    /** @return mixed */
    public function getId()
    {
        return $this->id;
    }

    /** @return mixed */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return User
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /** @return mixed */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /** @return mixed */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /** @return mixed */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    #endregion
    
    #region Public methods
    #endregion
    
    #region Protected methods
    #endregion
    
    #region Private methods
    #endregion
}