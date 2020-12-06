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
use App\Collection\Contact\EmailAddresses;
use App\Collection\Contact\PhoneNumbers;
use App\Collection\Contacts;
use App\Enumeration\Endpoint;
use App\Exception\Exception;
use App\Helper\DateHelper;
use App\Object\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class ContactService
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
     * Send a request to fetch the contacts from iCloud.
     *
     * @link project://docs/icloud/services/contacts/get-contacts.md
     * @return Contacts
     *
     * @throws Exception
     */
    public function getContacts()
    {
        if ($this->request->query->has("demo")) {
            $contacts = new Contacts($this->dateHelper);

            $phoneNumberLabels = [
                'MOBILE',
                'IPHONE',
                'HOME',
                'WORK',
                'MAIN',
                'HOME FAX',
                'WORK FAX',
                'PAGER',
                'OTHER'
            ];

            $emailAddressLabels = [
                'WORK',
                'HOME',
                'OTHER'
            ];

            for ($i = 1; $i <= 50; $i++) {
                $contact = new Contact($this->dateHelper);

                /*
                 * Phone Numbers
                 */

                $phoneNumbers = new PhoneNumbers($this->dateHelper);

                foreach ($phoneNumberLabels as $phoneNumberLabel) {
                    $phoneNumber = new Contact\PhoneNumber($this->dateHelper);
                    $phoneNumber->setPhoneNumber($this->faker->phoneNumber);
                    $phoneNumber->setLabel($phoneNumberLabel);
                    $phoneNumbers->add($phoneNumber);
                }

                $contact->setPhoneNumbers($phoneNumbers);

                /*
                 * Email addresses
                 */

                $emailAddresses = new EmailAddresses($this->dateHelper);

                foreach ($emailAddressLabels as $emailAddressLabel) {
                    $emailAddress = new Contact\EmailAddress($this->dateHelper);
                    $emailAddress->setEmailAddress($this->faker->email);
                    $emailAddress->setLabel($emailAddressLabel);
                    $emailAddresses->add($emailAddress);
                }

                $contact->setEmailAddresses($emailAddresses);

                /*
                 * General
                 */

                $contact->setBirthday($this->faker->dateTime);
                $contact->setLastName($this->faker->lastName);
                $contact->setJobTitle($this->faker->word);
                $contact->setCompanyName($this->faker->company);
                $contact->setIsCompany($this->faker->boolean);
                $contact->setPrefix($this->faker->title);
                $contact->setContactId($this->faker->uuid);
                $contact->setNotes($this->faker->sentence);
                $contact->setFirstName($this->faker->firstName);

                $contacts->add($contact);
            }

            return $contacts;
        } else {
            $json = $this->client
                ->reset()
                ->setMethod(Request::METHOD_GET)
                ->setEndpoint(Endpoint::CONTACTS)
                ->setPath("/co/startup")
                ->setQueryParams([
                    "clientVersion" => "2.1",
                    "locale" => $this->userService->getActiveUser()->getLanguage(),
                    "clientBuildNumber" => "1923Hotfix2",
                    "clientMasteringNumber" => "1923Hotfix2",
                    "clientId" => $this->userService->getActiveUser()->getClientId(),
                    "dsid" => $this->userService->getActiveUser()->getDsid(),
                    "lang" => $this->userService->getActiveUser()->getLanguage(),
                    "order" => "first,last"
                ])
                ->sendRequest(true)
                ->getJson();

            $contacts = new Contacts($this->dateHelper);
            $contacts->createFromJson($json);
            return $contacts;
        }
    }
}