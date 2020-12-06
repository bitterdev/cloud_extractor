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

class Part implements JsonSerializable
{
    /** @var string */
    protected $guid = '';
    /** @var string */
    protected $type = '';
    /** @var string */
    protected $content = '';
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
         * @link project://docs/icloud/services/mail/get-messagee.md
         * @link project://docs/icloud/services/mail/get-messages.md
         */

        if (is_array($json)) {
            if (isset($json["guid"])) {
                $this->setGuid((string)$json["guid"]);
            }

            if (isset($json["type"])) {
                $this->setType((string)$json["type"]);
            }

            if (isset($json["content"])) {
                $this->setContent((string)$json["content"]);
            }
        }
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
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

    public function jsonSerialize()
    {
        return [
            "guid" => $this->getGuid(),
            "type" => $this->getType(),
            "content" => $this->getContent()
        ];
    }
}