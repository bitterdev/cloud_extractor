<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Client;

use App\Cookie\DatabaseCookieJar;
use App\Entity\TrustToken;
use App\Enumeration\Endpoint;
use App\Exception\Exception;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;

class HttpClient
{
    const USER_AGENT = '"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36"';

    /** @var EntityManagerInterface */
    protected $entityManager;
    /** @var UserService */
    protected $userService;
    /** @var string */
    protected $method = Request::METHOD_GET;
    /** @var string */
    protected $endpoint = '';
    /** @var string */
    protected $path = '';
    /** @var array */
    protected $queryParams = [];
    /** @var array */
    protected $payload = [];
    /** @var array */
    protected $headers = [];
    /** @var string */
    protected $referer = '';
    /** @var string */
    protected $body = '';

    public function __construct(
        EntityManagerInterface $entityManager,
        UserService $userService
    )
    {
        $this->entityManager = $entityManager;
        $this->userService = $userService;
    }

    public function reset()
    {
        $this->method = Request::METHOD_GET;
        $this->referer = '';
        $this->body = '';
        $this->headers = [];
        $this->endpoint = '';
        $this->path = '';
        $this->queryParams = [];
        $this->payload = [];

        return $this;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getHost()
    {
        $urlParts = parse_url($this->getEndpointUrl($this->getEndpoint()));
        return $urlParts["host"];
    }

    public function isPost()
    {
        return $this->getMethod() === Request::METHOD_POST;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function getQueryParams()
    {
        return $this->queryParams;
    }

    public function hasQueryParams()
    {
        return count($this->getQueryParams()) > 0;
    }

    public function setQueryParams($queryParams)
    {
        $this->queryParams = $queryParams;
        return $this;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function hasPayload()
    {
        return count($this->getPayload()) > 0;
    }

    public function setPayload($payload)
    {
        $this->payload = $payload;
        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param string $endpoint
     * @return string
     * @throws Exception
     */
    private function getEndpointUrl($endpoint)
    {
        if (strpos($endpoint, "://") !== false) {
            return $endpoint;
        }

        switch ($endpoint) {
            case Endpoint::SETUP:
                return 'https://setup.icloud.com/';
            case Endpoint::IDMSA:
                return 'https://idmsa.apple.com/';
            default:
                $endpointEntity = $this->entityManager->getRepository(\App\Entity\Endpoint::class)->findOneBy([
                    "name" => $endpoint,
                    "account" => $this->userService->getActiveUser()
                ]);

                if ($endpointEntity instanceof \App\Entity\Endpoint) {
                    return $endpointEntity->getUrl();
                }

                throw new Exception("No endpoint configured.");
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getBaseUrl()
    {
        $baseUrl = $this->getEndpointUrl($this->getEndpoint());

        if (substr($baseUrl, strlen($baseUrl) - 1) !== "/") {
            $baseUrl .= "/";
        }

        return $baseUrl;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getUrl()
    {
        // @todo: Use Guzzle to build the url clean

        $path = $this->getPath();

        if (substr($path, 0, 1) === "/") {
            $path = substr($path, 1);
        }

        $url = sprintf(
            "%s%s%s",
            $this->getBaseUrl(),
            $path,
            $this->hasQueryParams() ? "?" . http_build_query($this->getQueryParams()) : ""
        );

        return $url;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function hasBody()
    {
        return strlen($this->getBody()) > 0;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function getReferer()
    {
        if (strlen($this->referer) > 0) {
            return $this->referer;
        } else {
            return "https://www.icloud.com";
        }
    }

    public function setReferer($referer)
    {
        $this->referer = $referer;
        return $this;
    }

    /**
     * @param bool $restApiRequest
     * @return Response
     *
     * @throws Exception
     */
    public function sendRequest($restApiRequest = false)
    {

        $client = new Client([
            'http_errors' => false,
            'cookies' => new DatabaseCookieJar($this->entityManager, $this->userService, true)
        ]);

        $headers = [
            "Connection" => "keep-alive",
            "Accept" => "application/json, text/javascript, */*; q=0.01",
            "Origin" => "https://www.icloud.com",
            "Referer" => $this->getReferer(),
            "Sec-Fetch-Mode" => "cors",
            "Sec-Fetch-Site" => "same-origin",
            "User-Agent" => self::USER_AGENT
        ];

        $headers = array_merge(
            $this->getHeaders(),

            $headers
        );

        if ($restApiRequest) {
            $headers = array_merge(
                $headers,
                [
                    ":authority:" => $this->getHost(),
                    ":method:" => $this->getMethod(),
                    ":path:" => $this->getPath() . "?" . http_build_query($this->getQueryParams()),
                    ":scheme:" => "https"
                ]
            );
        }

        $options = [
            "headers" => $headers
        ];

        if ($this->isPost()) {
            if ($this->hasPayload()) {
                $options["headers"]["Content-Type"] = "application/json";
                $options["json"] = $this->getPayload();
            } else if ($this->hasBody()) {
                $options["headers"]["Content-Type"] = "text/plain;charset=UTF-8";
                $options["body"] = $this->getBody();
            }

            $response = $client->post($this->getUrl(), $options);
        } else {
            /** @var \GuzzleHttp\Psr7\Response $response */
            $response = $client->get($this->getUrl(), $options);
        }

        /*
         * transform guzzle response to symfony response
         */

        $response = new Response(
            $response->getBody()->getContents(),
            $response->getStatusCode(),
            $response->getHeaders(),
            true
        );

        /*
         * Update widget key
         */

        $user = $this->userService->getActiveUser();

        if (strlen($response->getString("configBag.urls.accountLoginUI"))) {
            $queryString = parse_url($response->getString("configBag.urls.accountLoginUI"), PHP_URL_QUERY);

            parse_str($queryString, $queryParameters);

            if (isset($queryParameters["widgetKey"])) {
                $user->setWidgetKey($queryParameters["widgetKey"]);
            }
        }

        /*
         * Update dsid
         */

        if (strlen($response->getString("dsInfo.dsid")) > 0) {
            $user->setDsid($response->getString("dsInfo.dsid"));
        }

        /*
         * Update trust tokens
         */

        if (count($response->getArray("trustTokens")) > 0) {
            if (count($user->getTrustTokens()) > 0) {
                foreach ($user->getTrustTokens() as $trustTokenEntity) {
                    $this->entityManager->remove($trustTokenEntity);
                }
            }

            $this->entityManager->flush();

            foreach ($response->getArray("trustTokens") as $trustToken) {
                $trustTokenEntity = new TrustToken();
                $trustTokenEntity->setTrustToken($trustToken);
                $trustTokenEntity->setUser($user);
                $this->entityManager->persist($trustTokenEntity);
            }

            $this->entityManager->flush();
        }

        /*
         * Update endpoints
         */

        if (count($response->getArray("webservices")) > 0) {
            if (count($user->getEndpoints()) > 0) {
                foreach ($user->getEndpoints() as $endPointEntity) {
                    $this->entityManager->remove($endPointEntity);
                }
            }

            $this->entityManager->flush();

            foreach ($response->getArray("webservices") as $webserviceName => $webserviceData) {
                if (isset($webserviceData["url"])) {
                    $endPointEntity = new \App\Entity\Endpoint();
                    $endPointEntity->setUser($user);
                    $endPointEntity->setName($webserviceName);
                    $endPointEntity->setUrl($webserviceData["url"]);
                    $this->entityManager->persist($endPointEntity);
                }
            }

            $this->entityManager->flush();
        }

        /*
         * Update session token
         */

        if ($response->headers->has("X-Apple-Session-Token")) {
            $user->setSessionToken((string)$response->headers->get("X-Apple-Session-Token", ""));
        }

        /*
         * Update session id
         */

        if ($response->headers->has("X-Apple-ID-Session-Id")) {
            $user->setSessionId((string)$response->headers->get("X-Apple-ID-Session-Id", ""));
        }

        /*
         * Update scnt
         */

        if ($response->headers->has("scnt")) {
            $user->setScnt((string)$response->headers->get("scnt", ""));
        }

        /*
         * Check for response codes
         */

        $json = $response->getJson();

        /*
         * Fetch service errors #1
         */

        if (isset($json["service_errors"])) {
            $serviceErrors = $json["service_errors"];

            if (count($serviceErrors) > 0) {
                foreach ($serviceErrors as $serviceError) {
                    throw new Exception($serviceError);
                }
            }
        }

        /*
         * Fetch service errors #2
         */

        if (isset($json["serviceErrors"])) {
            $serviceErrors = $json["serviceErrors"];

            if (count($serviceErrors) > 0) {
                foreach ($serviceErrors as $serviceError) {
                    if (isset($serviceError["message"])) {
                        throw new Exception($serviceError["message"]);
                    }
                }
            }
        }

        /*
         * Fetch general errors
         */

        if (isset($json["error"])) {
            if (isset($json["reason"])) {
                throw new Exception($json["reason"]);
            } else {
                throw new Exception($json["error"]);
            }
        }

        if (isset($json["errorCode"])) {
            if (isset($json["errorReason"])) {
                throw new Exception($json["errorReason"]);
            }
        }

        if (isset($json["success"]) && !$json["success"]) {
            throw new Exception("Unknown Error.");
        }

        return $response;
    }


}