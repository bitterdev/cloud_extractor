<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Object\Mail;

use App\Helper\DateHelper;
use JsonSerializable;

class Folder implements JsonSerializable
{
    /** @var string */
    protected $guid = '';
    /** @var string */
    protected $name = '';
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
         * @link project://docs/icloud/services/mail/get-folders.md
         */

        if (is_array($json)) {
            if (isset($json["guid"])) {
                $this->setGuid((string)$json["guid"]);
            }

            if (isset($json["name"])) {
                $this->setName((string)$json["name"]);
            }
        }
    }

    public function getGuid()
    {
        return $this->guid;
    }

    public function setGuid($guid)
    {
        $this->guid = $guid;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "guid" => $this->getGuid(),
            "name" => $this->getName()
        ];
    }
}