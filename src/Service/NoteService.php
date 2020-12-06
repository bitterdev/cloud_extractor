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
use App\Collection\Notes;
use App\Enumeration\Endpoint;
use App\Exception\Exception;
use App\Helper\DateHelper;
use App\Object\Note;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class NoteService
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
     * Send a request to retrieve the notes from iCloud.
     *
     * @link project://docs/icloud/services/notes/get-notes.md
     * @return Notes
     *
     * @throws Exception
     *
     * @noinspection PhpUnused
     */
    public function getNotes()
    {
        if ($this->request->query->has("demo")) {
            $notes = new Notes($this->dateHelper);

            for ($i = 1; $i <= 50; $i++) {
                $note = new Note($this->dateHelper);

                $note->setModifiedAt($this->faker->dateTime);
                $note->setTitle($this->faker->sentence);
                $note->setText($this->faker->paragraph);
                $note->setCreatedAt($this->faker->dateTime);
                $note->setRecordName($this->faker->uuid);

                $notes->add($note);
            }

            return $notes;
        } else {
            $json = $this->client
                ->reset()
                ->setMethod(Request::METHOD_POST)
                ->setEndpoint(Endpoint::DATABASE)
                ->setPath("/database/1/com.apple.notes/production/private/records/query")
                ->setQueryParams([
                    "clientBuildNumber" => "1923Hotfix2",
                    "clientMasteringNumber" => "1923Hotfix2",
                    "clientId" => $this->userService->getActiveUser()->getClientId(),
                    "dsid" => $this->userService->getActiveUser()->getDsid()
                ])
                ->setPayload([
                    "zoneID" => [
                        "zoneName" => "Notes"
                    ],
                    "resultsLimit" => 100000,
                    "desiredKeys" => [
                        "TitleEncrypted",
                        "SnippetEncrypted",
                        "FirstAttachmentUTIEncrypted",
                        "FirstAttachmentThumbnail",
                        "FirstAttachmentThumbnailOrientation",
                        "ModificationDate",
                        "Deleted",
                        "Folders",
                        "Folder",
                        "Attachments",
                        "ParentFolder",
                        "Folder",
                        "Note",
                        "LastViewedModificationDate",
                        "MinimumSupportedNotesVersion"
                    ],
                    "query" => [
                        "recordType" => "SearchIndexes",
                        "filterBy" => [
                            [
                                "comparator" => "EQUALS",
                                "fieldName" => "indexName",
                                "fieldValue" => [
                                    "value" => "recents",
                                    "type" => "STRING"
                                ]
                            ]
                        ],
                        "sortBy" => [
                            [
                                "fieldName" => "modTime",
                                "ascending" => false
                            ]
                        ]
                    ]
                ])
                ->sendRequest()
                ->getJson();

            $notes = new Notes($this->dateHelper);
            $notes->createFromJson($json);
            return $notes;
        }
    }
}