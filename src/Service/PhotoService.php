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
use App\Collection\Photos;
use App\Enumeration\Endpoint;
use App\Exception\Exception;
use App\Helper\DateHelper;
use App\Object\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class PhotoService
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
     * Send a request to fetch photos and videos from the iCloud photo service.
     *
     * @link project://docs/icloud/services/photos/init.md
     * @link project://docs/icloud/services/photos/get-photos.md
     * @return Photos
     *
     * @throws Exception
     *
     * @noinspection PhpUnused
     */
    public function getPhotos()
    {
        if ($this->request->query->has("demo")) {
            $photos = new Photos($this->dateHelper);

            for($i = 1; $i <= 50; $i++) {
                $photo = new Photo($this->dateHelper);

                $photo->setName(sprintf(
                    "%s.jpg",
                    $this->faker->asciify("******")
                ));

                $photo->setThumbnailFileDownloadUrl($this->faker->imageUrl());
                $photo->setThumbnailFileSize($this->faker->numberBetween());
                $photo->setOriginalFileSize($this->faker->numberBetween());
                $photo->setOriginalFileDownloadUrl($this->faker->imageUrl());


                $photos->add($photo);
            }

            return $photos;
        } else {
            $totalRecords = [
                "records" => []
            ];

            $zones = $this->client
                ->reset()
                ->setMethod(Request::METHOD_GET)
                ->setEndpoint(Endpoint::DATABASE)
                ->setPath("/database/1/com.apple.photos.cloud/production/private/zones/list")
                ->setQueryParams([
                    "clientBuildNumber" => "1923Hotfix3",
                    "clientMasteringNumber" => "1923Hotfix3",
                    "ckjsBuildVersion" => "1923ProjectDev34",
                    "ckjsVersion" => "2.6.1",
                    "remapEnums" => true,
                    "getCurrentSyncToken" => true,
                    "clientId" => $this->userService->getActiveUser()->getClientId(),
                    "dsid" => $this->userService->getActiveUser()->getDsid()
                ])
                ->sendRequest()
                ->getArray("zones");

            foreach($zones as $zone) {
                $records = $this->client
                    ->reset()
                    ->setMethod(Request::METHOD_POST)
                    ->setEndpoint(Endpoint::DATABASE)
                    ->setPath("/database/1/com.apple.photos.cloud/production/private/records/query")
                    ->setQueryParams([
                        "clientBuildNumber" => "1923Hotfix3",
                        "clientMasteringNumber" => "1923Hotfix3",
                        "ckjsBuildVersion" => "1923ProjectDev34",
                        "ckjsVersion" => "2.6.1",
                        "remapEnums" => true,
                        "getCurrentSyncToken" => true,
                        "clientId" => $this->userService->getActiveUser()->getClientId(),
                        "dsid" => $this->userService->getActiveUser()->getDsid()
                    ])
                    ->setPayload([
                        "query" => [
                            "recordType" => "CPLAssetAndMasterByAssetDateWithoutHiddenOrDeleted",
                            "filterBy" => [
                                [
                                    "fieldName" => "startRank",
                                    "comparator" => "EQUALS",
                                    "fieldValue" => [
                                        "value" => 0,
                                        "type" => "INT64"
                                    ]
                                ],
                                [
                                    "fieldName" => "direction",
                                    "comparator" => "EQUALS",
                                    "fieldValue" => [
                                        "value" => "ASCENDING",
                                        "type" => "STRING"
                                    ]
                                ]
                            ]
                        ],
                        "zoneID" => $zone["zoneID"],
                        "desiredKeys" => [
                            "addedDate",
                            "adjustmentRenderType",
                            "adjustmentType",
                            "assetDate",
                            "assetHDRType",
                            "assetSubtype",
                            "assetSubtypeV2",
                            "burstFlags",
                            "burstFlagsExt",
                            "burstId",
                            "captionEnc",
                            "codec",
                            "customRenderedValue",
                            "dataClassType",
                            "dateExpunged",
                            "duration",
                            "filenameEnc",
                            "importedBy",
                            "isDeleted",
                            "isExpunged",
                            "isFavorite",
                            "isHidden",
                            "itemType",
                            "locationEnc",
                            "locationLatitude",
                            "locationLongitude",
                            "locationV2Enc",
                            "masterRef",
                            "mediaMetaDataEnc",
                            "mediaMetaDataType",
                            "orientation",
                            "originalOrientation",
                            "recordChangeTag",
                            "recordName",
                            "recordType",
                            "remappedRef",
                            "resJPEGFullFileType",
                            "resJPEGFullFingerprint",
                            "resJPEGFullHeight",
                            "resJPEGFullRes",
                            "resJPEGFullWidth",
                            "resJPEGLargeFileType",
                            "resJPEGLargeFingerprint",
                            "resJPEGLargeHeight",
                            "resJPEGLargeRes",
                            "resJPEGLargeWidth",
                            "resJPEGMedFileType",
                            "resJPEGMedFingerprint",
                            "resJPEGMedHeight",
                            "resJPEGMedRes",
                            "resJPEGMedWidth",
                            "resJPEGThumbFileType",
                            "resJPEGThumbFingerprint",
                            "resJPEGThumbHeight",
                            "resJPEGThumbRes",
                            "resJPEGThumbWidth",
                            "resOriginalAltFileType",
                            "resOriginalAltFingerprint",
                            "resOriginalAltHeight",
                            "resOriginalAltRes",
                            "resOriginalAltWidth",
                            "resOriginalFileType",
                            "resOriginalFingerprint",
                            "resOriginalHeight",
                            "resOriginalRes",
                            "resOriginalVidComplFileType",
                            "resOriginalVidComplFingerprint",
                            "resOriginalVidComplHeight",
                            "resOriginalVidComplRes",
                            "resOriginalVidComplWidth",
                            "resOriginalWidth",
                            "resSidecarFileType",
                            "resSidecarFingerprint",
                            "resSidecarHeight",
                            "resSidecarRes",
                            "resSidecarWidth",
                            "resVidFullFileType",
                            "resVidFullFingerprint",
                            "resVidFullHeight",
                            "resVidFullRes",
                            "resVidFullWidth",
                            "resVidMedFileType",
                            "resVidMedFingerprint",
                            "resVidMedHeight",
                            "resVidMedRes",
                            "resVidMedWidth",
                            "resVidSmallFileType",
                            "resVidSmallFingerprint",
                            "resVidSmallHeight",
                            "resVidSmallRes",
                            "resVidSmallWidth",
                            "timeZoneOffset",
                            "vidComplDispScale",
                            "vidComplDispValue",
                            "vidComplDurScale",
                            "vidComplDurValue",
                            "vidComplVisibilityState",
                            "zoneID"
                        ],
                        "resultsLimit" => 100000
                    ])
                    ->sendRequest()
                    ->getArray("records");

                foreach($records as $record) {
                    $totalRecords["records"][] = $record;
                }
            }

            $photos = new Photos($this->dateHelper);
            $photos->createFromJson($totalRecords);
            return $photos;
        }
    }
}