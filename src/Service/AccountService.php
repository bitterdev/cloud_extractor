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
use App\Enumeration\Endpoint;
use App\Event\LoginEvent;
use App\Event\LogoutEvent;
use App\Exception\Exception;
use App\Subscriber\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class AccountService
{
    /** @var HttpClient */
    protected $client;
    /** @var UserService */
    protected $userService;
    /** @var EntityManagerInterface */
    protected $entityManager;
    /** @var EventDispatcherInterface */
    protected $eventDispatcher;
    /** @var RequestStack */
    protected $requestStack;
    /** @var Request */
    protected $request;

    public function __construct(
        HttpClient $httpClient,
        UserService $userService,
        EventDispatcherInterface $eventDispatcher,
        RequestStack $requestStack,
        EntityManagerInterface $entityManager
    )
    {
        $this->client = $httpClient;
        $this->userService = $userService;
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->requestStack = $requestStack;
        $this->request = $this->requestStack->getCurrentRequest();

        if (!$this->request->query->has("demo")) {
            $this->eventDispatcher->addSubscriber(new EventSubscriber());
        }
    }

    /**
     * @return array
     * @throws Exception
     */
    private function getHeaders()
    {
        return [
            "X-Apple-Domain-Id" => 3,
            "X-Apple-Frame-Id" => $this->userService->getActiveUser()->getClientId(),
            "X-Apple-I-FD-Client-Info" => json_encode([
                "U" => HttpClient::USER_AGENT,
                "L" => $this->userService->getActiveUser()->getLanguage(),
                "Z" => date('P'),
                "V" => "1.1",
                "F" => ""
            ]),
            "scnt" => $this->userService->getActiveUser()->getScnt(),
            "X-Apple-ID-Session-Id" => $this->userService->getActiveUser()->getSessionId(),
            "X-Apple-OAuth-Client-Id" => $this->userService->getActiveUser()->getWidgetKey(),
            "X-Apple-OAuth-Client-Type" => "firstPartyAuth",
            "X-Apple-OAuth-Redirect-URI" => "https://www.icloud.com",
            "X-Apple-OAuth-Response-Mode" => "web_message",
            "X-Apple-OAuth-Response-Type" => "code",
            "X-Apple-Widget-Key" => $this->userService->getActiveUser()->getWidgetKey(),
            "X-Requested-With" => "XMLHttpRequest"
        ];
    }

    /**
     * Send a request to check if the current session is valid.
     *
     * @link project://docs/icloud/services/account/validate-session.md
     * @return bool
     *
     * @throws Exception
     */
    public function validateSession()
    {
        if ($this->request->query->has("demo")) {
            return true;
        }

        $this->client
            ->reset()
            ->setMethod(Request::METHOD_POST)
            ->setEndpoint(Endpoint::SETUP)
            ->setPath("/setup/ws/1/validate")
            ->setQueryParams([
                "clientBuildNumber" => "1923Hotfix2",
                "clientMasteringNumber" => "1923Hotfix2",
                "clientId" => $this->userService->getActiveUser()->getClientId()
            ])
            ->setBody("null")
            ->sendRequest();

        return true;
    }

    /**
     * Send a request to submitting login credentials to iCloud.
     *
     * @link project://docs/icloud/services/account/login.md
     * @param string $email
     * @param string $password
     * @return bool
     *
     * @throws Exception
     */
    public function login($email, $password)
    {
        if (strlen($email) === 0) {
            throw new Exception("You need to enter a valid email address.");
        }

        if (strlen($password) === 0) {
            throw new Exception("You need to enter a valid password.");
        }

        if (!$this->request->query->has("demo")) {
            $this->client
                ->reset()
                ->setMethod(Request::METHOD_POST)
                ->setEndpoint(Endpoint::IDMSA)
                ->setHeaders($this->getHeaders())
                ->setPath("/appleauth/auth/signin")
                ->setPayload([
                    "accountName" => $email,
                    "rememberMe" => true,
                    "password" => $password,
                    "trustTokens" => $this->userService->getActiveUser()->getTrustTokens()
                ])
                ->sendRequest();

            $account = $this->userService->getActiveUser();
            $account->setEmail($email);
            $account->setPassword($password);

            $this->entityManager->persist($account);
            $this->entityManager->flush();
        }

        return true;
    }

    /**
     * Send a request to logout from iCloud.
     *
     * @link project://docs/icloud/services/account/logout.md
     * @return bool
     *
     * @throws Exception
     *
     * @noinspection PhpUnused
     */
    public function logout()
    {
        if (!$this->request->query->has("demo")) {
            $this->client
                ->reset()
                ->setMethod(Request::METHOD_POST)
                ->setEndpoint(Endpoint::SETUP)
                ->setHeaders($this->getHeaders())
                ->setPath("/setup/ws/1/logout")
                ->setQueryParams([
                    "clientBuildNumber" => "1923Hotfix2",
                    "clientMasteringNumber" => "1923Hotfix2",
                    "clientId" => $this->userService->getActiveUser()->getClientId(),
                    "dsid" => $this->userService->getActiveUser()->getDsid()
                ])
                ->setPayload([
                    "trustBrowser" => true,
                    "allBrowsers" => false
                ])
                ->sendRequest();
        }

        $this->eventDispatcher->dispatch(new LogoutEvent(), LogoutEvent::NAME);

        return true;
    }

    /**
     * Send a request to check if multi factor authentication for the login process is required.
     *
     * @link project://docs/icloud/services/account/check-mfa.md
     * @return bool
     *
     * @throws Exception
     */
    public function checkMultiFactorAuthentication()
    {
        if ($this->request->query->has("demo")) {
            return true;
        } else {
            $response = $this->client
                ->reset()
                ->setMethod(Request::METHOD_POST)
                ->setEndpoint(Endpoint::SETUP)
                ->setPath("/setup/ws/1/accountLogin")
                ->setQueryParams([
                    "clientBuildNumber" => "1923Hotfix2",
                    "clientMasteringNumber" => "1923Hotfix2",
                    "clientId" => $this->userService->getActiveUser()->getClientId()
                ])
                ->setPayload([
                    "dsWebAuthToken" => $this->userService->getActiveUser()->getSessionId(),
                    "accountCountryCode" => $this->userService->getActiveUser()->getCountryCode(),
                    "extended_login" => false
                ])
                ->sendRequest()
                ->validateStatusCode();

            return $response->getBool("hsaChallengeRequired");
        }
    }

    /**
     * Send a request to submitting the 2-factor-code to iCloud.
     *
     * @link project://docs/icloud/services/account/submit-code.md
     * @param string $code
     * @return bool
     *
     * @throws Exception
     */
    public function submitCode($code)
    {
        if (strlen($code) === 0) {
            throw new Exception("You need to enter a valid code.");
        }

        if ($this->request->query->has("demo")) {
            // Do Nothing
        } else {
            $this->client
                ->reset()
                ->setMethod(Request::METHOD_POST)
                ->setEndpoint(Endpoint::IDMSA)
                ->setHeaders($this->getHeaders())
                ->setPath("/appleauth/auth/verify/trusteddevice/securitycode")
                ->setPayload([
                    "securityCode" => [
                        "code" => $code
                    ]
                ])
                ->sendRequest()
                ->validateStatusCode();
        }

        $this->checkMultiFactorAuthentication(); // need to execute accountLogin again to retrieve the X-APPLE-WEBAUTH-TOKEN cookie

        $this->eventDispatcher->dispatch(new LoginEvent(), LoginEvent::NAME);

        return true;
    }

    /**
     * Send a request to trust the client. This will skip multi factor authorization in the future.
     *
     * @link project://docs/icloud/services/account/trust-device.md
     * @return bool
     *
     * @throws Exception
     */
    public function trustDevice()
    {
        if ($this->request->query->has("demo")) {
            return true;
        }

        $this->client
            ->reset()
            ->setMethod(Request::METHOD_GET)
            ->setEndpoint(Endpoint::IDMSA)
            ->setHeaders($this->getHeaders())
            ->setPath("/appleauth/auth/2sv/trust")
            ->sendRequest()
            ->validateStatusCode();

        return true;
    }
}