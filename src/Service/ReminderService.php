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
use App\Collection\Reminders;
use App\Enumeration\Endpoint;
use App\Enumeration\ReminderPriority;
use App\Exception\Exception;
use App\Helper\DateHelper;
use App\Object\Reminder;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class ReminderService
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
     * Send a request to get the reminders from iCloud.
     *
     * @link project://docs/icloud/services/reminders/get-reminders.md
     * @return Reminders
     *
     * @throws Exception
     *
     * @noinspection PhpUnused
     */
    public function getReminders()
    {
        if ($this->request->query->has("demo")) {
            $reminders = new Reminders($this->dateHelper);

            $priorities = [
                ReminderPriority::LOW,
                ReminderPriority::MEDIUM,
                ReminderPriority::HIGH
            ];

            for ($i = 1; $i <= 50; $i++) {
                $reminder = new Reminder($this->dateHelper);

                $reminder->setTitle($this->faker->sentence);
                $reminder->setDueDate($this->faker->dateTime);
                $reminder->setDescription($this->faker->paragraph);
                $reminder->setPriority($this->faker->randomElement($priorities));

                $reminders->add($reminder);
            }

            return $reminders;
        } else {
            $json = $this->client
                ->reset()
                ->setMethod(Request::METHOD_GET)
                ->setEndpoint(Endpoint::REMINDERS)
                ->setPath("/rd/startup")
                ->setReferer("https://www.icloud.com/applications/reminders/current/de-de/index.html?rootDomain=www")
                ->setQueryParams([
                    "clientBuildNumber" => "1925Project45",
                    "clientMasteringNumber" => "1925B46",
                    "clientVersion" => "4.0",
                    "lang" => $this->userService->getActiveUser()->getLanguage(),
                    "usertz" => $this->userService->getActiveUser()->getTimeZone(),
                    "clientId" => $this->userService->getActiveUser()->getClientId(),
                    "dsid" => $this->userService->getActiveUser()->getDsid()
                ])
                ->sendRequest(true)
                ->getJson();

            $reminders = new Reminders($this->dateHelper);
            $reminders->createFromJson($json);
            return $reminders;
        }
    }
}