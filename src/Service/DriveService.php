<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Service;

use App\Client\HttpClient;
use App\Collection\Files;
use App\Enumeration\Endpoint;
use App\Enumeration\FileType;
use App\Exception\Exception;
use App\Helper\DateHelper;
use App\Object\File;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class DriveService
{
    /** @var RequestStack */
    protected $requestStack;
    /** @var EntityManagerInterface */
    protected $entityManager;
    /** @var HttpClient */
    protected $client;
    /** @var Generator */
    protected $faker;
    /** @var Request|null */
    protected $request;
    /** @var DateHelper */
    protected $dateHelper;
    /** @var UserService */
    protected $userService;

    public function __construct(
        HttpClient $httpClient,
        EntityManagerInterface $entityManager,
        DateHelper $dateHelper,
        RequestStack $requestStack,
        UserService $userService
    )
    {
        $this->entityManager = $entityManager;
        $this->client = $httpClient;
        $this->faker = Factory::create();
        $this->dateHelper = $dateHelper;
        $this->requestStack = $requestStack;
        $this->request = $this->requestStack->getCurrentRequest();
        $this->userService = $userService;
    }

    /**
     * Send a request to retrieve a file list of the given directory from iCloud Drive.
     *
     * @link project://docs/icloud/services/drive/get-files.md
     * @param string $driveWsId
     * @return Files
     *
     * @throws Exception
     */
    public function getFiles($driveWsId = 'FOLDER::com.apple.CloudDocs::root')
    {
        if ($this->request->query->has("demo")) {
            $files = new Files($this->dateHelper);

            $fileTypes = [FileType::FILE, FileType::FOLDER];

            for ($i = 1; $i <= 50; $i++) {
                $file = new File($this->dateHelper);

                $fileName = sprintf(
                    "%s.%s",
                    $this->faker->asciify("******"),
                    $this->faker->fileExtension
                );

                $file->setType($this->faker->randomElement($fileTypes));
                $file->setName($fileName);
                $file->setDocWsId($this->faker->asciify("**********"));
                $file->setDriveWsId($this->faker->asciify("**********"));

                $files->add($file);
            }

            return $files;
        } else {
            $json = $this->client
                ->reset()
                ->setMethod(Request::METHOD_POST)
                ->setEndpoint(Endpoint::DRIVE)
                ->setPath("/retrieveItemDetailsInFolders")
                ->setQueryParams([
                    "clientBuildNumber" => "1925Project78",
                    "clientMasteringNumber" => "1925B46",
                    "clientId" => $this->userService->getActiveUser()->getClientId(),
                    "dsid" => $this->userService->getActiveUser()->getDsid()
                ])
                ->setPayload([[
                    "drivewsid" => $driveWsId,
                    "partialData" => false
                ]])
                ->sendRequest(true)
                ->getJson();

            $files = new Files($this->dateHelper);
            $files->createFromJson($json);
            return $files;
        }
    }

    /**
     * Send a request to retrieve the download link of a given document id from iCloud Drive.
     *
     * @link project://docs/icloud/services/drive/get-download-link.md
     * @param string $docWsId
     * @return string
     *
     * @throws Exception
     */
    public function getDownloadLink($docWsId)
    {
        if ($this->request->query->has("demo")) {
            return $this->faker->imageUrl();
        } else {
            $fileEntries = $this->client
                ->reset()
                ->setMethod(Request::METHOD_POST)
                ->setEndpoint(Endpoint::DOCUMENTS)
                ->setPath("/ws/com.apple.CloudDocs/download/batch")
                ->setQueryParams([
                    "clientBuildNumber" => "1923Hotfix2",
                    "clientMasteringNumber" => "1923Hotfix2",
                    "clientId" => $this->userService->getActiveUser()->getClientId(),
                    "dsid" => $this->userService->getActiveUser()->getDsid(),
                    "token" => $this->userService->getActiveUser()->getSessionId()
                ])
                ->setPayload([
                    "document_id" => $docWsId
                ])
                ->sendRequest(true)
                ->getJson();

            if (is_array($fileEntries)) {
                foreach ($fileEntries as $fileEntry) {
                    if (isset($fileEntry["document_id"]) && $fileEntry["document_id"] == $docWsId &&
                        is_array($fileEntry["data_token"]) &&
                        isset($fileEntry["data_token"]["url"])) {

                        return $fileEntry["data_token"]["url"];
                    }
                }
            }

            throw new Exception("The download link could not resolved.");
        }
    }
}