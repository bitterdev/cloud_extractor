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
class User
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
    protected $email;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $password;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $dsid;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $scnt;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $sessionId;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $sessionToken;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $widgetKey;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $clientId;

    /**
     * @var bool
     * @ORM\Column(type="boolean") *
     */
    protected $isTemp = true;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $countryCode;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $language;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $timeZone;

    /**
     * @var Owner
     * @ORM\ManyToOne(targetEntity="App\Entity\Owner")
     * @ORM\JoinColumn(name="ownerId", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $owner;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cookie", mappedBy="user", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     *
     * @var Cookie[]
     */
    protected $cookies;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TrustToken", mappedBy="user", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     *
     * @var TrustToken[]
     */
    protected $trustTokens;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Endpoint", mappedBy="user", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     *
     * @var Endpoint[]
     */
    protected $endPoints;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getDsid()
    {
        return $this->dsid;
    }

    /**
     * @param string $dsid
     * @return User
     */
    public function setDsid($dsid)
    {
        $this->dsid = $dsid;
        return $this;
    }

    /**
     * @return string
     */
    public function getScnt()
    {
        return $this->scnt;
    }

    /**
     * @param string $scnt
     * @return User
     */
    public function setScnt($scnt)
    {
        $this->scnt = $scnt;
        return $this;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     * @return User
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getWidgetKey()
    {
        return $this->widgetKey;
    }

    /**
     * @param string $widgetKey
     * @return User
     */
    public function setWidgetKey($widgetKey)
    {
        $this->widgetKey = $widgetKey;
        return $this;
    }

    /**
     * @return Owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param Owner $owner
     * @return User
     */
    public function setOwner(Owner $owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return Cookie[]
     */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * @param Cookie[] $cookies
     * @return User
     */
    public function setCookies($cookies)
    {
        $this->cookies = $cookies;
        return $this;
    }

    /**
     * @return TrustToken[]
     */
    public function getTrustTokens()
    {
        return $this->trustTokens;
    }

    /**
     * @param TrustToken[] $trustTokens
     * @return User
     */
    public function setTrustTokens($trustTokens)
    {
        $this->trustTokens = $trustTokens;
        return $this;
    }

    /**
     * @return Endpoint[]
     */
    public function getEndpoints()
    {
        return $this->endPoints;
    }

    /**
     * @param Endpoint[] $endPoints
     * @return User
     */
    public function setEndpoints($endPoints)
    {
        $this->endPoints = $endPoints;
        return $this;
    }

    /**
     * @return string
     */
    public function getSessionToken()
    {
        return $this->sessionToken;
    }

    /**
     * @param string $sessionToken
     * @return User
     */
    public function setSessionToken($sessionToken)
    {
        $this->sessionToken = $sessionToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return User
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTemp()
    {
        return $this->isTemp;
    }

    /**
     * @param bool $isTemp
     * @return User
     */
    public function setIsTemp($isTemp)
    {
        $this->isTemp = $isTemp;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return "usa"; // @todo: remove me
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     * @return User
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return "en"; // @todo: remove me
        return $this->language;
    }

    /**
     * @param string $language
     * @return User
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimeZone()
    {
        return date_default_timezone_get(); // @todo: remove me
        return $this->timeZone;
    }

    /**
     * @param string $timeZone
     * @return User
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;
        return $this;
    }

}