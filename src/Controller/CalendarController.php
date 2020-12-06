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
use App\Helper\DateHelper;
use App\Response\ErrorResponse;
use App\Response\SuccessResponse;
use App\Service\CalendarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{

    /**
     * Send a request to fetch the events within a given date range from iCloud calendar.
     *
     * @Route("/api/calendar/get_events")
     *
     * @link project://docs/services/calendar/get-events.md
     * @param Request $request
     * @param CalendarService $calendarService
     * @param DateHelper $dateHelper
     * @return JsonResponse
     */
    public function getEvents(
        Request $request,
        CalendarService $calendarService,
        DateHelper $dateHelper
    )
    {
        try {
            return new SuccessResponse([
                "events" => $calendarService->getEvents(
                    $dateHelper->convertAppleDate($request->query->get("from", "")),
                    $dateHelper->convertAppleDate($request->query->get("to", ""))
                )
            ]);
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }
}