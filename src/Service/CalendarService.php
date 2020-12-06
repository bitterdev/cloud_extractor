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
use App\Collection\Events;
use App\Enumeration\Endpoint;
use App\Exception\Exception;
use App\Helper\DateHelper;
use App\Object\Event;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class CalendarService
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
     * Send a request to fetch the events within a given date range from iCloud calendar.
     *
     * @link project://docs/icloud/services/calendar/get-events.md
     * @param DateTime $from
     * @param DateTime $to
     * @return Events
     *
     * @throws Exception
     *
     * @noinspection PhpUnused
     */
    public function getEvents(DateTime $from, DateTime $to)
    {
        if ($this->request->query->has("demo")) {
            $events = new Events($this->dateHelper);

            for ($i = 1; $i <= 50; $i++) {
                $event = new Event($this->dateHelper);

                $startDate = $this->faker->dateTimeBetween($from, $to);
                $endDate = $startDate->add(new DateInterval("PT1H"));

                $event->setTitle($this->faker->sentence);
                $event->setStartDate($startDate);
                $event->setEndDate($endDate);
                $event->setAllDay($this->faker->boolean);

                $events->add($event);
            }

            return $events;
        } else {
            $json = $this->client
                ->reset()
                ->setMethod(Request::METHOD_GET)
                ->setEndpoint(Endpoint::CALENDAR)
                ->setPath("/ca/startup")
                ->setReferer("https://www.icloud.com/applications/calendar/current/de-de/index.html?rootDomain=www")
                ->setQueryParams([
                    "clientBuildNumber" => "1925Project48",
                    "clientMasteringNumber" => "1925B46",
                    "clientId" => $this->userService->getActiveUser()->getClientId(),
                    "dsid" => $this->userService->getActiveUser()->getDsid(),
                    "clientVersion" => "5.1",
                    "lang" => $this->userService->getActiveUser()->getLanguage(),
                    "usertz" => $this->userService->getActiveUser()->getTimeZone(),
                    "startDate" => $from->format("Y-m-d"),
                    "endDate" => $to->format("Y-m-d")
                ])
                ->sendRequest(true)
                ->getJson();

            $events = new Events($this->dateHelper);
            $events->createFromJson($json);
            return $events;
        }
    }
}