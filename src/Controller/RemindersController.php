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
use App\Service\ReminderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RemindersController extends AbstractController
{

    /**
     * Send a request to get the reminders from iCloud.
     *
     * @Route("/api/reminders/get_reminders")
     *
     * @link project://docs/services/reminders/get-reminders.md
     * @param ReminderService $reminderService
     * @return JsonResponse
     */
    public function getReminders(
        ReminderService $reminderService
    )
    {
        try {
            return new SuccessResponse([
                "reminders" => $reminderService->getReminders()
            ]);
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }
}