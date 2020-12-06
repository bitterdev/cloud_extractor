<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Service;

use App\Entity\User;
use App\Entity\Owner;
use App\Exception\Exception;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class UserService
{
    /** @var RequestStack */
    protected $requestStack;
    /** @var EntityManagerInterface */
    protected $entityManager;
    /** @var Request|null */
    protected $request;
    /** @var Owner|object|null */
    protected $ownerEntity;

    /**
     * UserService constructor.
     * @param EntityManagerInterface $entityManager
     * @param RequestStack $requestStack
     * @throws Exception
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        RequestStack $requestStack
    )
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->request = $this->requestStack->getCurrentRequest();

        /*
         * Get the owner
         */

        $ownerEntity = $this->entityManager->getRepository(Owner::class)->findOneBy([
            "apiKey" => $this->request->query->get("apiKey", "")
        ]);

        if (!$ownerEntity instanceof Owner) {
            throw new Exception("The provided api key is invalid.");
        }

        if (!$ownerEntity->isActive()) {
            throw new Exception("The api key is not active.");
        }

        $this->ownerEntity = $ownerEntity;
    }

    /**
     * @return User
     * @throws Exception
     */
    public function addNewUser()
    {
        try {
            $clientId = Uuid::uuid1()->toString();
        } catch (\Exception $err) {
            throw new Exception("Can't create unique identifier.");
        }

        $accountEntity = new User();

        $accountEntity->setOwner($this->ownerEntity);
        $accountEntity->setLanguage("en");
        $accountEntity->setCountryCode("usa");
        $accountEntity->setTimeZone(date_default_timezone_get());
        $accountEntity->setClientId($clientId);

        $this->entityManager->persist($accountEntity);
        $this->entityManager->flush();

        return $accountEntity;
    }

    /**
     * @param int $userId
     * @return User
     * @throws Exception
     */
    public function getUserById($userId)
    {
        $accountEntity = $this->entityManager->getRepository(User::class)->findOneBy([
            "id" => $userId,
            "owner" => $this->ownerEntity
        ]);

        if ($accountEntity instanceof User) {
            return $accountEntity;
        } else {
            throw new Exception("The requested account id is invalid.");
        }
    }

    /**
     * @return User
     * @throws Exception
     */
    public function getActiveUser()
    {
        return $this->getUserById((int)$this->request->query->get("accountId", 1));
    }
}