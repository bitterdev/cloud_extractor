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
use App\Service\PhotoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PhotosController extends AbstractController
{
    /**
     * Send a request to fetch photos and videos from the iCloud photo service.
     *
     * @Route("/api/photos/get_photos")
     *
     * @link project://docs/services/photos/get-photos.md
     * @param PhotoService $photoService
     * @return JsonResponse
     */
    public function getPhotos(
        PhotoService $photoService
    )
    {
        try {
            return new SuccessResponse([
                "photos" => $photoService->getPhotos()
            ]);
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }
}