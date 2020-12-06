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
use App\Service\DriveService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DriveController extends AbstractController
{

    /**
     * Send a request to retrieve a file list of the given directory from iCloud Drive.
     *
     * @Route("/api/drive/get_files")
     *
     * @link project://docs/services/drive/get-files.md
     * @param Request $request
     * @param DriveService $driveService
     * @return JsonResponse
     */
    public function getFiles(
        Request $request,
        DriveService $driveService
    )
    {
        try {
            return new SuccessResponse([
                "files" => $driveService->getFiles(
                    (string)$request->query->get("driveWsId", "FOLDER::com.apple.CloudDocs::root")
                )
            ]);
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }

    /**
     * Send a request to retrieve the download link of a given document id from iCloud Drive.
     *
     * @Route("/api/drive/get_download_link")
     *
     * @link project://docs/services/drive/get-download-link.md
     * @param Request $request
     * @param DriveService $driveService
     * @return JsonResponse
     */
    public function getDownloadLink(
        Request $request,
        DriveService $driveService
    )
    {
        try {
            return new SuccessResponse([
                "downloadLink" => $driveService->getDownloadLink((string)$request->query->get("docWsId", ""))
            ]);
        } catch (Exception $err) {
            return new ErrorResponse($err);
        }
    }


    /**
     * Downloads a URL from iCloud
     *
     * @Route("/api/drive/download_url")
     * @param Request $request
     */
    public function downloadUrl(
        Request $request
    )
    {
        $url = $request->query->get("url", "");

        $fp = fopen($url, 'rb');

        foreach (get_headers($url) as $header) {
            header($header);
        }

        fpassthru($fp);
        exit;
    }
}