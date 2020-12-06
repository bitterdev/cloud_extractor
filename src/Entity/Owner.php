<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Owner
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $apiKey;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $passwordHash;

    /**
     * @var int
     * @ORM\Column(type="integer") *
     */
    protected $maxUsers = 0;

    /**
     * @var bool
     * @ORM\Column(type="boolean") *
     */
    protected $isActive = false;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="owner", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     *
     * @var User[]
     */
    protected $users;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Owner
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return Owner
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Owner
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    /**
     * @param string $passwordHash
     * @return Owner
     */
    public function setPasswordHash($passwordHash)
    {
        $this->passwordHash = $passwordHash;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return Owner
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return User[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param User[] $users
     * @return Owner
     */
    public function setUsers($users)
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxUsers()
    {
        return $this->maxUsers;
    }

    /**
     * @param int $maxUsers
     * @return Owner
     */
    public function setMaxUsers($maxUsers)
    {
        $this->maxUsers = $maxUsers;
        return $this;
    }

}