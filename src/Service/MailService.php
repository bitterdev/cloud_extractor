<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Service;

use App\Client\HttpClient;
use App\Collection\Mail\Folders;
use App\Collection\Mail\Messages;
use App\Collection\Mail\Parts;
use App\Enumeration\Endpoint;
use App\Exception\Exception;
use App\Helper\DateHelper;
use App\Object\Mail\Folder;
use App\Object\Mail\Message;
use App\Object\Mail\Part;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class MailService
{
    /** @var RequestStack */
    protected $requestStack;
    /** @var EntityManagerInterface */
    protected $entityManager;
    /** @var HttpClient */
    protected $client;
    /** @var Generator */
    protected $faker;
    /** @var Request|null */
    protected $request;
    /** @var DateHelper */
    protected $dateHelper;
    /** @var UserService */
    protected $userService;

    public function __construct(
        HttpClient $httpClient,
        EntityManagerInterface $entityManager,
        DateHelper $dateHelper,
        RequestStack $requestStack,
        UserService $userService
    )
    {
        $this->entityManager = $entityManager;
        $this->client = $httpClient;
        $this->faker = Factory::create();
        $this->dateHelper = $dateHelper;
        $this->requestStack = $requestStack;
        $this->request = $this->requestStack->getCurrentRequest();
        $this->userService = $userService;
    }

    /**
     * @return string
     */
    private function getRequestCounter()
    {
        return time() * 1000 . "/" . time();
    }

    /**
     * Send a request to retrieve the mail folders from iCloud.
     *
     * @link project://docs/icloud/services/mail/get-folders.md
     * @return Folders
     *
     * @throws Exception
     *
     * @noinspection PhpUnused
     */
    public function getFolders()
    {
        if ($this->request->query->has("demo")) {
            $folders = new Folders($this->dateHelper);

            $folderNames = [
                "INBOX",
                "DRAFTS",
                "TRASH",
                "SENT"
            ];

            foreach ($folderNames as $folderName) {
                $folder = new Folder($this->dateHelper);

                $folder->setName($folderName);
                $folder->setGuid($this->faker->uuid);

                $folders->add($folder);
            }

            return $folders;
        } else {
            $json = $this->client
                ->reset()
                ->setMethod(Request::METHOD_POST)
                ->setEndpoint(Endpoint::MAIL)
                ->setPath("/wm/folder")
                ->setQueryParams([
                    "clientBuildNumber" => "1923Project60",
                    "clientMasteringNumber" => "1923B31",
                    "clientId" => $this->userService->getActiveUser()->getClientId(),
                    "dsid" => $this->userService->getActiveUser()->getDsid()
                ])
                ->setPayload([
                    "jsonrpc" => "2.0",
                    "id" => $this->getRequestCounter(),
                    "method" => "list",
                    "userStats" => "",
                    "systemStats" => [0, 0, 0, 0]
                ])
                ->sendRequest()
                ->getJson();

            $folders = new Folders($this->dateHelper);
            $folders->createFromJson($json);
            return $folders;
        }
    }

    /**
     * Send a request to retrieve the messages from a given mail folders.
     *
     * @link project://docs/icloud/services/mail/get-messages.md
     * @param string $folderGuid
     * @param int $start
     * @param int $count
     * @return Messages
     *
     * @throws Exception
     */
    public function getMessages($folderGuid, $start = 0, $count = 50)
    {
        if ($this->request->query->has("demo")) {
            $messages = new Messages($this->dateHelper);

            for ($i = 1; $i <= 50; $i++) {
                $message = new Message($this->dateHelper);

                $parts = new Parts($this->dateHelper);
                $part = new Part($this->dateHelper);

                $part->setType($this->faker->mimeType);
                $part->setGuid($this->faker->uuid);

                $parts->add($part);

                $message->setFrom([$this->faker->email]);
                $message->setParts($parts);
                $message->setGuid($this->faker->uuid);
                $message->setTo([$this->faker->email]);
                $message->setUnread($this->faker->boolean);
                $message->setSentDate($this->faker->dateTime);
                $message->setSubject($this->faker->sentence);

                $messages->add($message);
            }

            return $messages;
        } else {
            $json = $this->client
                ->reset()
                ->setMethod(Request::METHOD_POST)
                ->setEndpoint(Endpoint::MAIL)
                ->setPath("/wm/message")
                ->setQueryParams([
                    "clientBuildNumber" => "1923Project60",
                    "clientMasteringNumber" => "1923B31",
                    "clientId" => $this->userService->getActiveUser()->getClientId(),
                    "dsid" => $this->userService->getActiveUser()->getDsid()
                ])
                ->setPayload([
                    "jsonrpc" => "2.0",
                    "id" => $this->getRequestCounter(),
                    "method" => "list",
                    "params" => [
                        "guid" => $folderGuid,
                        "sorttype" => "Date",
                        "sortorder" => "descending",
                        "searchtype" => null,
                        "searchtext" => null,
                        "requesttype" => "index",
                        "selected" => $start,
                        "count" => $count,
                        "rollbackslot" => "-1.-1"
                    ],
                    "userStats" => "",
                    "systemStats" => [0, 0, 0, 0]
                ])
                ->sendRequest()
                ->getJson();

            $messages = new Messages($this->dateHelper);
            $messages->createFromJson($json);
            return $messages;
        }
    }

    /**
     * Send a request to retrieve the message.
     *
     * @link project://docs/icloud/services/mail/get-message.md
     * @param string $messageGuid
     * @param array $messageParts
     * @return Message
     *
     * @throws Exception
     *
     * @noinspection PhpUnused
     */
    public function getMessage($messageGuid, $messageParts)
    {
        if ($this->request->query->has("demo")) {
            $message = new Message($this->dateHelper);

            $parts = new Parts($this->dateHelper);
            $part = new Part($this->dateHelper);

            $part->setGuid($this->faker->uuid);
            $part->setType($this->faker->mimeType);
            $part->setContent($this->faker->paragraph);

            $parts->add($part);

            $message->setParts($parts);
            $message->setFrom([$this->faker->email]);
            $message->setGuid($this->faker->uuid);
            $message->setTo([$this->faker->email]);
            $message->setUnread($this->faker->boolean);
            $message->setSentDate($this->faker->dateTime);
            $message->setSubject($this->faker->sentence);

            return $message;
        } else {
            $response = $this->client
                ->reset()
                ->setMethod(Request::METHOD_POST)
                ->setEndpoint(Endpoint::MAIL)
                ->setPath("/wm/message")
                ->setQueryParams([
                    "clientBuildNumber" => "1923Project60",
                    "clientMasteringNumber" => "1923B31",
                    "clientId" => $this->userService->getActiveUser()->getClientId(),
                    "dsid" => $this->userService->getActiveUser()->getDsid()
                ])
                ->setPayload([
                    "jsonrpc" => "2.0",
                    "id" => $this->getRequestCounter(),
                    "method" => "get",
                    "params" => [
                        "guid" => $messageGuid,
                        "parts" => $messageParts
                    ],
                    "userStats" => "",
                    "systemStats" => [0, 3436, 0, 0]
                ])
                ->sendRequest();

            $results = $response->getArray("result");

            if (is_array($results)) {
                foreach ($results as $result) {
                    if ($result["guid"] == $messageGuid) {
                        $message = new Message($this->dateHelper);
                        $message->createFromJson($result);
                        return $message;
                    }
                }
            }

            throw new Exception("The message could not be retrieved.");
        }

    }
}