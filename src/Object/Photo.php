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

class Photo implements JsonSerializable
{
    /** @var string */
    protected $name = '';
    /** @var string */
    protected $originalFileDownloadUrl = '';
    /** @var int */
    protected $originalFileSize = 0;
    /** @var string */
    protected $thumbnailFileDownloadUrl = '';
    /** @var int */
    protected $thumbnailFileSize = 0;
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
         * @link project://docs/icloud/services/photos/get-photos.md
         */
        if (is_array($json) && isset($json["fields"]) && is_array($json["fields"])) {
            if (isset($json["fields"]["resJPEGMedFileType"]) && is_array($json["fields"]["resJPEGMedFileType"])) {
                if (isset($json["fields"]["resJPEGMedFileType"]["value"])) {
                    $this->setName((string)$json["fields"]["resJPEGMedFileType"]["value"]);
                }
            }

            if (isset($json["fields"]["resOriginalRes"]) && is_array($json["fields"]["resOriginalRes"])) {
                if (isset($json["fields"]["resOriginalRes"]["value"]) && is_array($json["fields"]["resOriginalRes"]["value"])) {
                    if (isset($json["fields"]["resOriginalRes"]["value"]["downloadURL"])) {
                        $this->setOriginalFileDownloadUrl((string)$json["fields"]["resOriginalRes"]["value"]["downloadURL"]);
                    }

                    if (isset($json["fields"]["resOriginalRes"]["size"])) {
                        $this->setOriginalFileSize((int)$json["fields"]["resOriginalRes"]["value"]["size"]);
                    }
                }
            }

            if (isset($json["fields"]["resJPEGThumbRes"]) && is_array($json["fields"]["resJPEGThumbRes"])) {
                if (isset($json["fields"]["resJPEGThumbRes"]["value"]) && is_array($json["fields"]["resJPEGThumbRes"]["value"])) {
                    if (isset($json["fields"]["resJPEGThumbRes"]["value"]["downloadURL"])) {
                        $this->setThumbnailFileDownloadUrl((string)$json["fields"]["resJPEGThumbRes"]["value"]["downloadURL"]);
                    }

                    if (isset($json["fields"]["resJPEGThumbRes"]["value"]["size"])) {
                        $this->setThumbnailFileSize((int)$json["fields"]["resJPEGThumbRes"]["value"]["size"]);
                    }
                }
            }
        }
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

    public function getOriginalFileDownloadUrl()
    {
        return $this->originalFileDownloadUrl;
    }

    public function setOriginalFileDownloadUrl($originalFileDownloadUrl)
    {
        $this->originalFileDownloadUrl = $originalFileDownloadUrl;
        return $this;
    }

    public function getOriginalFileSize()
    {
        return $this->originalFileSize;
    }

    public function setOriginalFileSize($originalFileSize)
    {
        $this->originalFileSize = $originalFileSize;
        return $this;
    }

    public function getThumbnailFileDownloadUrl()
    {
        return $this->thumbnailFileDownloadUrl;
    }

    public function setThumbnailFileDownloadUrl($thumbnailFileDownloadUrl)
    {
        $this->thumbnailFileDownloadUrl = $thumbnailFileDownloadUrl;
        return $this;
    }

    public function getThumbnailFileSize()
    {
        return $this->thumbnailFileSize;
    }

    public function setThumbnailFileSize($thumbnailFileSize)
    {
        $this->thumbnailFileSize = $thumbnailFileSize;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "name" => $this->getName(),
            "originalFileDownloadUrl" => $this->getOriginalFileDownloadUrl(),
            "originalFileSize" => $this->getOriginalFileSize(),
            "thumbnailFileDownloadUrl" => $this->getThumbnailFileDownloadUrl(),
            "thumbnailFileSize" => $this->getThumbnailFileSize()
        ];
    }
}