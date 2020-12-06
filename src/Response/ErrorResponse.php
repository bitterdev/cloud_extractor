<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Response;

use App\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class ErrorResponse extends JsonResponse
{
    public function __construct(Exception $err)
    {
        parent::__construct(
            [
                "success" => false,
                "data" => null,
                "error" => $err->getMessage()
            ],
            self::HTTP_OK,
            [
                "Access-Control-Allow-Origin" => "*"
            ]
        );
    }
}