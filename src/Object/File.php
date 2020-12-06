<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Object;

use App\Enumeration\FileType;
use App\Helper\DateHelper;
use JsonSerializable;

class File implements JsonSerializable
{
    /** @var string */
    protected $driveWsId = '';
    /** @var string */
    protected $docWsId = '';
    /** @var string */
    protected $type = FileType::FILE;
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
         * @link project://docs/icloud/services/drive/get-files.md
         */

        if (is_array($json)) {
            if (isset($json["drivewsid"])) {
                $this->setDriveWsId((string)$json["drivewsid"]);
            }

            if (isset($json["docwsid"])) {
                $this->setDocWsId((string)$json["docwsid"]);
            }

            if (isset($json["type"])) {
                $this->setType((string)$json["type"]);
            }

            if (isset($json["name"])) {
                $this->setName((string)$json["name"]);
            }
        }
    }

    public function getDriveWsId()
    {
        return $this->driveWsId;
    }

    public function setDriveWsId($driveWsId)
    {
        $this->driveWsId = $driveWsId;
        return $this;
    }

    public function getDocWsId()
    {
        return $this->docWsId;
    }

    public function setDocWsId($docWsId)
    {
        $this->docWsId = $docWsId;
        return $this;
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function isFolder()
    {
        return $this->type === FileType::FOLDER;
    }

    public function isFile()
    {
        return $this->type === FileType::FILE;
    }

    public function jsonSerialize()
    {
        return [
            "driveWsId" => $this->getDriveWsId(),
            "docWsId" => $this->getDocWsId(),
            "name" => $this->getName(),
            "type" => $this->getType(),
            "isFile" => $this->isFile(),
            "isFolder" => $this->isFolder()
        ];
    }
}