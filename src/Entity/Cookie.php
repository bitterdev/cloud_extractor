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
use GuzzleHttp\Cookie\SetCookie;

/**
 * @ORM\Entity
 */
class Cookie
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $user;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $value;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $domain;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) *
     */
    protected $path = '/';

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true) *
     */
    protected $maxAge;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true) *
     */
    protected $expires;

    /**
     * @var bool
     * @ORM\Column(type="boolean") *
     */
    protected $secure = false;

    /**
     * @var bool
     * @ORM\Column(type="boolean") *
     */
    protected $discard = false;

    /**
     * @var bool
     * @ORM\Column(type="boolean") *
     */
    protected $httpOnly = false;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Cookie
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Cookie
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Cookie
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return Cookie
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return Cookie
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Cookie
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxAge()
    {
        return $this->maxAge;
    }

    /**
     * @param int $maxAge
     * @return Cookie
     */
    public function setMaxAge($maxAge)
    {
        $this->maxAge = $maxAge;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param int $expires
     * @return Cookie
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSecure()
    {
        return $this->secure;
    }

    /**
     * @param bool $secure
     * @return Cookie
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDiscard()
    {
        return $this->discard;
    }

    /**
     * @param bool $discard
     * @return Cookie
     */
    public function setDiscard($discard)
    {
        $this->discard = $discard;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHttpOnly()
    {
        return $this->httpOnly;
    }

    /**
     * @param bool $httpOnly
     * @return Cookie
     */
    public function setHttpOnly($httpOnly)
    {
        $this->httpOnly = $httpOnly;
        return $this;
    }

    public function getCookieObject()
    {
        $setCookie = new SetCookie();

        $setCookie->setName($this->getName());
        $setCookie->setPath($this->getPath());
        $setCookie->setDiscard($this->isDiscard());
        $setCookie->setDomain($this->getDomain());
        $setCookie->setExpires($this->getExpires());
        $setCookie->setHttpOnly($this->isHttpOnly());
        $setCookie->setMaxAge($this->getMaxAge());
        $setCookie->setSecure($this->isSecure());
        $setCookie->setValue($this->getValue());

        return $setCookie;
    }

    public function createFromCookieObject(SetCookie $cookieObject, User $user)
    {
        $this->setName($cookieObject->getName());
        $this->setPath($cookieObject->getPath());
        $this->setDiscard($cookieObject->getDiscard());
        $this->setDomain($cookieObject->getDomain());
        $this->setExpires($cookieObject->getExpires());
        $this->setHttpOnly($cookieObject->getHttpOnly());
        $this->setMaxAge($cookieObject->getMaxAge());
        $this->setSecure($cookieObject->getSecure());
        $this->setValue($cookieObject->getValue());
        $this->setUser($user);
    }

}