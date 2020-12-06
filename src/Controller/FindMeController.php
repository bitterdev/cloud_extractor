<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Controller;

use App\Exception\Exception;
use App\Response\ErrorResponse;
use App\Response\SuccessResponse;
use App\Service\FindMeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FindMeController extends AbstractController
{

    /**
     * Send a request to initialize the find me service.
     *
     * @Route("/api/find_me/get_locations")
     *
     * @link project://docs/services/find-me/init.md
     * @param FindMeService $findMeService
     * @return JsonResponse
     */
    public function getLocations(
        FindMeService $findMeService
    )
    {
        try {
            return new SuccessResponse([
                "locations" => $findMeService->getLocations()
            ]);
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }
}