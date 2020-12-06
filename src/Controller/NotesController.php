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
use App\Service\NoteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class NotesController extends AbstractController
{

    /**
     * Send a request to retrieve the notes from iCloud.
     *
     * @Route("/api/notes/get_notes")
     *
     * @link project://docs/services/notes/get-notes.md
     * @param NoteService $noteService
     * @return JsonResponse
     */
    public function getNotes(
        NoteService $noteService
    )
    {
        try {
            return new SuccessResponse([
                "notes" => $noteService->getNotes()
            ]);
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }
}