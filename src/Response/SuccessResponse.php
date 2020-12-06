<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class SuccessResponse extends JsonResponse
{
    public function __construct($data = [])
    {
        parent::__construct(
            [
                "success" => true,
                "data" => $data,
                "error" => null
            ],
            self::HTTP_OK,
            [
                "Access-Control-Allow-Origin" => "*"
            ]
        );
    }
}