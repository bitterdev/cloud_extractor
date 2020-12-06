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
use App\Service\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    /**
     * Send a request to retrieve the mail folders from iCloud.
     *
     * @Route("/api/mail/get_folders")
     *
     * @link project://docs/services/mail/get-folders.md
     * @param MailService $mailService
     * @return JsonResponse
     */
    public function getFolders(
        MailService $mailService
    )
    {
        try {
            return new SuccessResponse([
                "folders" => $mailService->getFolders()
            ]);
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }

    /**
     * Send a request to retrieve the messages from a given mail folders.
     *
     * @Route("/api/mail/get_messages")
     *
     * @link project://docs/services/mail/get-messages.md
     * @param Request $request
     * @param MailService $mailService
     * @return JsonResponse
     */
    public function getMessages(
        Request $request,
        MailService $mailService
    )
    {
        try {
            return new SuccessResponse([
                "messages" => $mailService->getMessages(
                    (string)$request->query->get("folderId", ""),
                    (int)$request->query->get("start", 0),
                    (int)$request->query->get("count", 50)
                )
            ]);
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }

    /**
     * Send a request to retrieve the message.
     *
     * @Route("/api/mail/get_message")
     *
     * @link project://docs/services/mail/get-message.md
     * @param Request $request
     * @param MailService $mailService
     * @return JsonResponse
     */
    public function getMessage(
        Request $request,
        MailService $mailService
    )
    {
        try {
            return new SuccessResponse([
                "message" => $mailService->getMessage(
                    (string)$request->query->get("messageId", ""),
                    (array)$request->query->get("messageParts", [])
                )
            ]);
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }
}