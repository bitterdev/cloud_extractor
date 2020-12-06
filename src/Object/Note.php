<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Object;

use App\Helper\DateHelper;
use JsonSerializable;
use DateTime;

class Note implements JsonSerializable
{
    /** @var string */
    protected $recordName = '';
    /** @var DateTime */
    protected $createdAt;
    /** @var DateTime */
    protected $modifiedAt;
    /** @var string */
    protected $text = '';
    /** @var string */
    protected $title = '';
    /** @var DateHelper */
    protected $dateHelper;

    public function __construct(
        DateHelper $dateHelper
    )
    {
        $this->dateHelper = $dateHelper;
        $this->createdAt = new DateTime();
        $this->modifiedAt = new DateTime();
    }

    public function createFromJson($json = null)
    {

        /**
         * Parse JSON and create object.
         *
         * @link project://docs/icloud/services/notes/get-notes.md
         */

        if (is_array($json)) {
            if (isset($json["recordName"])) {
                $this->setRecordName((string)$json["recordName"]);
            }

            if (is_array($json["created"]) && isset($json["created"]["timestamp"])) {
                $this->setCreatedAt($this->dateHelper->convertJavaScriptTimeStamp((int)$json["created"]["timestamp"]));
            }

            if (is_array($json["modified"]) && isset($json["modified"]["timestamp"])) {
                $this->setModifiedAt($this->dateHelper->convertJavaScriptTimeStamp((int)$json["modified"]["timestamp"]));
            }

            if (is_array($json["fields"])) {
                if (isset($json["fields"]["TitleEncrypted"])) {
                    if (is_array($json["fields"]["TitleEncrypted"]) && isset($json["fields"]["TitleEncrypted"]["value"])) {
                        $this->setTitle((string)base64_decode($json["fields"]["TitleEncrypted"]["value"]));
                    }
                }

                if (isset($json["fields"]["TextDataEncrypted"])) {
                    if (is_array($json["fields"]["TextDataEncrypted"]) && isset($json["fields"]["TextDataEncrypted"]["value"])) {
                        $this->setText((string)base64_decode($json["fields"]["TextDataEncrypted"]["value"]));
                    }
                }
            }
        }
    }

    public function getRecordName()
    {
        return $this->recordName;
    }

    public function setRecordName($recordName)
    {
        $this->recordName = $recordName;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;
        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "recordName" => $this->getRecordName(),
            "createdAt" => $this->getCreatedAt()->format("c"),
            "modifiedAt" => $this->getModifiedAt()->format("c"),
            "text" => $this->getText(),
            "title" => $this->getTitle()
        ];
    }
}