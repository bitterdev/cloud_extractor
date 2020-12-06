<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Client;

use Adbar\Dot;
use App\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class Response extends JsonResponse
{
    /**
     * @return array
     */
    public function getJson()
    {
        $json = json_decode($this->getContent(), true);

        if (!is_array($json)) {
            $json = [];
        }

        return $json;
    }

    /**
     * @param string $namespace
     * @return array|string
     */
    private function getItem($namespace = '')
    {
        $json = $this->getJson();
        $dot = new Dot($json);
        return $dot->get($namespace);
    }

    /**
     * @param string $namespace
     * @return array
     */
    public function getArray($namespace = '')
    {
        return (array)$this->getItem($namespace);
    }

    /**
     * @param string $namespace
     * @return string
     */
    public function getString($namespace = '')
    {
        return (string)$this->getItem($namespace);
    }

    /**
     * @param string $namespace
     * @return bool
     */
    public function getBool($namespace = '')
    {
        return (bool)$this->getItem($namespace);
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function validateStatusCode()
    {
        if (!in_array($this->getStatusCode(), [200, 204])) {
            throw new Exception("Invalid response code");
        }

        return $this;
    }
}