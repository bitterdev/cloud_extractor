<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Cookie;

use App\Entity\Cookie;
use App\Exception\Exception;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;

class DatabaseCookieJar extends CookieJar
{
    /** @var EntityManagerInterface */
    protected $entityManager;
    /** @var UserService */
    protected $userService;
    /** @var bool */
    protected $storeSessionCookies = false;

    /**
     * DatabaseCookieJar constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserService $userService
     * @param bool $storeSessionCookies
     * @throws Exception
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        UserService $userService,
        $storeSessionCookies = false
    )
    {
        parent::__construct();

        $this->entityManager = $entityManager;
        $this->userService = $userService;
        $this->storeSessionCookies = $storeSessionCookies;

        $this->load();
    }

    /**
     * @throws Exception
     */
    public function __destruct()
    {
        $this->save();
    }

    /**
     * @throws Exception
     */
    public function save()
    {
        foreach ($this->userService->getActiveUser()->getCookies() as $cookieEntity) {
            $this->entityManager->remove($cookieEntity);
        }

        $this->entityManager->flush();

        foreach ($this as $cookie) {
            /** @var SetCookie $cookie */
            if (CookieJar::shouldPersist($cookie, $this->storeSessionCookies)) {
                $cookieEntity = new Cookie();
                $cookieEntity->createFromCookieObject($cookie, $this->userService->getActiveUser());
                $this->entityManager->persist($cookieEntity);
            }
        }

        $this->entityManager->flush();
    }

    /**
     * @throws Exception
     */
    public function load()
    {
        foreach ($this->userService->getActiveUser()->getCookies() as $cookieEntity) {
            $this->setCookie($cookieEntity->getCookieObject());
        }
    }
}
