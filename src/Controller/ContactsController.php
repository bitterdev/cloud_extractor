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
use App\Service\ContactService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ContactsController extends AbstractController
{

    /**
     * Send a request to fetch the contacts from iCloud.
     *
     * @Route("/api/contacts/get_contacts")
     *
     * @link project://docs/services/contacts/get-contacts.md
     * @param ContactService $contactService
     * @return JsonResponse
     */
    public function getContacts(
        ContactService $contactService
    )
    {
        try {
            return new SuccessResponse([
                "contacts" => $contactService->getContacts()
            ]);
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }
}