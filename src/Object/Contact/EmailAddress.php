<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Object\Contact;

use App\Helper\DateHelper;
use JsonSerializable;

class EmailAddress implements JsonSerializable
{
    /** @var string */
    protected $emailAddress = '';
    /** @var string */
    protected $label = '';
    /** @var DateHelper */
    protected $dateHelper;

    public function __construct(
        DateHelper $dateHelper
    )
    {
        $this->dateHelper = $dateHelper;
    }

    public function createFromJson($json = null)
    {
        /**
         * Parse JSON and create object.
         *
         * @link project://docs/icloud/services/contacts/get-contacts.md
         */

        if (is_array($json)) {
            if (isset($json["field"])) {
                $this->setEmailAddress((string)$json["field"]);
            }

            if (isset($json["label"])) {
                $this->setLabel((string)$json["label"]);
            }
        }
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "emailAddress" => $this->getEmailAddress(),
            "label" => $this->getLabel()
        ];
    }
}