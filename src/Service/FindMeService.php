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
use App\Collection\Locations;
use App\Enumeration\Endpoint;
use App\Exception\Exception;
use App\Helper\DateHelper;
use App\Object\Location;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class FindMeService
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
     * Send a request to initialize the find me service.
     *
     * @link project://docs/icloud/services/find-me/init.md
     * @param bool $skipAuthentication
     * @return Locations
     *
     * @throws Exception
     * @noinspection PhpUnused
     */
    public function getLocations($skipAuthentication = false)
    {
        if ($this->request->query->has("demo")) {
            $locations = new Locations($this->dateHelper);
            $location = new Location($this->dateHelper);
            $location->setLatitude($this->faker->latitude);
            $location->setLongitude($this->faker->longitude);
            $locations->add($location);
            return $locations;
        } else {
            $response = $this->client
                ->reset()
                ->setMethod(Request::METHOD_POST)
                ->setEndpoint(Endpoint::FIND_ME)
                ->setPath("/fmipservice/client/web/initClient")
                ->setQueryParams([
                    "clientBuildNumber" => "1923Project36",
                    "clientMasteringNumber" => "1923B31",
                    "clientId" => $this->userService->getActiveUser()->getClientId(),
                    "dsid" => $this->userService->getActiveUser()->getDsid()
                ])
                ->setPayload([
                    "clientContext" => [
                        "appName" => "iCloud Find (Web)",
                        "appVersion" => "2.0",
                        "timezone" => $this->userService->getActiveUser()->getTimeZone(),
                        "inactiveTime" => 1082,
                        "apiVersion" => "3.0",
                        "deviceListVersion" => 1,
                        "fmly" => true
                    ]
                ])
                ->sendRequest();

            if (!$skipAuthentication && $response->getStatusCode() === 450) {
                /*
                 * Re-login required
                 */

                $response = $this->client
                    ->reset()
                    ->setMethod(Request::METHOD_POST)
                    ->setEndpoint(Endpoint::SETUP)
                    ->setPath("/setup/ws/1/accountLogin")
                    ->setQueryParams([
                        "clientBuildNumber" => "1925Project78",
                        "clientMasteringNumber" => "1925B46",
                        "clientId" => $this->userService->getActiveUser()->getClientId(),
                        "dsid" => $this->userService->getActiveUser()->getDsid()
                    ])
                    ->setPayload([
                        "appName" => "find",
                        "apple_id" => $this->userService->getActiveUser()->getEmail(),
                        "password" => $this->userService->getActiveUser()->getPassword(),
                        "trustTokens" => $this->userService->getActiveUser()->getPassword()
                    ])
                    ->sendRequest();

                if ($response->getStatusCode() === 200) {
                    return $this->getLocations(true);
                }
            }

            $locations = new Locations($this->dateHelper);
            $locations->createFromJson($response->getJson());
            return $locations;
        }
    }
}