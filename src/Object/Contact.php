<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Object;

use App\Collection\Contact\EmailAddresses;
use App\Collection\Contact\PhoneNumbers;
use App\Helper\DateHelper;
use JsonSerializable;
use DateTime;

class Contact implements JsonSerializable
{
    /** @var string */
    protected $contactId = '';
    /** @var string */
    protected $prefix = '';
    /** @var string */
    protected $suffix = '';
    /** @var string */
    protected $jobTitle = '';
    /** @var string */
    protected $firstName = '';
    /** @var string */
    protected $middleName = '';
    /** @var string */
    protected $lastName = '';
    /** @var string */
    protected $notes = '';
    /** @var string */
    protected $companyName = '';
    /** @var bool */
    protected $isCompany = false;
    /** @var DateTime */
    protected $birthday;
    /** @var EmailAddresses */
    protected $emailAddresses;
    /** @var PhoneNumbers */
    protected $phoneNumbers;
    /** @var DateHelper */
    protected $dateHelper;

    public function __construct(
        DateHelper $dateHelper
    )
    {
        $this->dateHelper = $dateHelper;
        $this->birthday = new DateTime();
        $this->emailAddresses = new EmailAddresses($this->dateHelper);
        $this->phoneNumbers = new PhoneNumbers($this->dateHelper);
    }

    public function createFromJson($json = null)
    {
        /**
         * Parse JSON and create object.
         *
         * @link project://docs/icloud/services/contacts/get-contacts.md
         */

        if (is_array($json)) {
            if (isset($json["contactId"])) {
                $this->setContactId((string)$json["contactId"]);
            }

            if (isset($json["prefix"])) {
                $this->setPrefix((string)$json["prefix"]);
            }

            if (isset($json["suffix"])) {
                $this->setSuffix((string)$json["suffix"]);
            }

            if (isset($json["jobTitle"])) {
                $this->setJobTitle((string)$json["jobTitle"]);
            }

            if (isset($json["firstName"])) {
                $this->setFirstName((string)$json["firstName"]);
            }

            if (isset($json["middleName"])) {
                $this->setMiddleName((string)$json["middleName"]);
            }

            if (isset($json["lastName"])) {
                $this->setLastName((string)$json["lastName"]);
            }

            if (isset($json["notes"])) {
                $this->setNotes((string)$json["notes"]);
            }

            if (isset($json["isCompany"])) {
                $this->setIsCompany((bool)$json["isCompany"]);
            }

            if (isset($json["companyName"])) {
                $this->setCompanyName((string)$json["companyName"]);
            }

            if (isset($json["emailAddresses"])) {
                $emailAddress = new EmailAddresses($this->dateHelper);
                $emailAddress->createFromJson($json["emailAddresses"]);
                $this->setEmailAddresses($emailAddress);
            }

            if (isset($json["phones"])) {
                $phoneNumber = new PhoneNumbers($this->dateHelper);
                $phoneNumber->createFromJson($json["phones"]);
                $this->setPhoneNumbers($phoneNumber);
            }

            if (isset($json["birthday"])) {
                $this->setBirthday($this->dateHelper->convertAppleDate($json["birthday"]));
            }
        }
    }

    public function getContactId()
    {
        return $this->contactId;
    }

    public function setContactId($contactId)
    {
        $this->contactId = $contactId;
        return $this;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function getSuffix()
    {
        return $this->suffix;
    }

    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
        return $this;
    }

    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getMiddleName()
    {
        return $this->middleName;
    }

    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }

    public function getCompanyName()
    {
        return $this->companyName;
    }

    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function isCompany()
    {
        return $this->isCompany;
    }

    public function setIsCompany($isCompany)
    {
        $this->isCompany = $isCompany;
        return $this;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function getEmailAddresses()
    {
        return $this->emailAddresses;
    }

    public function setEmailAddresses($emailAddresses)
    {
        $this->emailAddresses = $emailAddresses;
        return $this;
    }

    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    public function setPhoneNumbers($phoneNumbers)
    {
        $this->phoneNumbers = $phoneNumbers;
        return $this;
    }

    public function getFullName()
    {
        $fullName = "";

        if (strlen($this->getPrefix()) > 0) {
            $fullName .= $this->getPrefix() . " ";
        }

        $fullName .= $this->getFirstName();

        if (strlen($this->getMiddleName()) > 0) {
            $fullName .= (strlen($fullName) > 0 ? " " : "") . $this->getMiddleName() . " ";
        }

        $fullName .= (strlen($fullName) > 0 ? " " : "") . $this->getLastName();

        if (strlen($this->getSuffix()) > 0) {
            $fullName .= (strlen($fullName) > 0 ? " " : "") . $this->getSuffix();
        }

        return $fullName;
    }

    public function getDisplayName()
    {
        if ($this->isCompany()) {
            return $this->getCompanyName();
        } else {
            return $this->getFullName();
        }
    }

    public function jsonSerialize()
    {
        return [
            "contactId" => $this->getContactId(),
            "prefix" => $this->getPrefix(),
            "suffix" => $this->getSuffix(),
            "jobTitle" => $this->getJobTitle(),
            "firstName" => $this->getFirstName(),
            "middleName" => $this->getMiddleName(),
            "lastName" => $this->getLastName(),
            "notes" => $this->getNotes(),
            "companyName" => $this->getCompanyName(),
            "isCompany" => $this->isCompany(),
            "birthday" => $this->getBirthday()->format("c"),
            "phoneNumbers" => $this->getPhoneNumbers(),
            "emailAddresses" => $this->getEmailAddresses(),
            "displayName" => $this->getDisplayName()
        ];
    }
}