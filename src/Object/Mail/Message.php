<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Object\Mail;

use App\Collection\Mail\Parts;
use App\Helper\DateHelper;
use JsonSerializable;
use DateTime;

class Message implements JsonSerializable
{
    /** @var string */
    protected $guid = '';
    /** @var string */
    protected $longHeader = '';
    /** @var string */
    protected $subject = '';
    /** @var array */
    protected $from = [];
    /** @var array */
    protected $to = [];
    /** @var DateTime */
    protected $sentDate;
    /** @var bool */
    protected $unread = false;
    /** @var Parts */
    protected $parts;
    /** @var DateHelper */
    protected $dateHelper;

    public function __construct(
        DateHelper $dateHelper
    )
    {
        $this->dateHelper = $dateHelper;
        $this->sentDate = new DateTime();
        $this->parts = new Parts($this->dateHelper);
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

            if (isset($json["to"])) {
                $this->setTo((array)$json["to"]);
            }

            if (isset($json["from"])) {
                $this->setFrom([$json["from"]]);
            }

            if (isset($json["subject"])) {
                $this->setSubject((string)$json["subject"]);
            }

            if (isset($json["longHeader"])) {
                $this->setLongHeader((string)$json["longHeader"]);
            }
            if (isset($json["sentdate"])) {
                $this->setSentDate($this->dateHelper->convertJavaScriptDateTime((string)$json["sentdate"]));
            }

            if (isset($json["unread"])) {
                $this->setUnread((bool)$json["unread"]);
            }

            if (is_array($json["parts"])) {
                $parts = new Parts($this->dateHelper);
                $parts->createFromJson($json["parts"]);
                $this->setParts($parts);
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

    public function getLongHeader()
    {
        return $this->longHeader;
    }

    public function setLongHeader($longHeader)
    {
        $this->longHeader = $longHeader;
        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    public function getContent()
    {
        foreach ($this->getParts() as $part) {
            if ($part->getType() === "CoreMail.MessagePart") {
                return $part->getContent();
            }
        }

        return '';
    }


    public function getSentDate()
    {
        return $this->sentDate;
    }

    public function setSentDate($sentDate)
    {
        $this->sentDate = $sentDate;
        return $this;
    }

    public function isUnread()
    {
        return $this->unread;
    }

    public function setUnread($unread)
    {
        $this->unread = $unread;
        return $this;
    }

    public function getParts()
    {
        return $this->parts;
    }

    public function setParts($parts)
    {
        $this->parts = $parts;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "guid" => $this->getGuid(),
            "longHeader" => $this->getLongHeader(),
            "subject" => $this->getSubject(),
            "from" => $this->getFrom(),
            "to" => $this->getTo(),
            "content" => $this->getContent(),
            "sentDate" => $this->getSentDate()->format("c"),
            "unread" => $this->isUnread(),
            "parts" => $this->getParts()
        ];
    }
}