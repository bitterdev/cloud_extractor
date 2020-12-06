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

class Location implements JsonSerializable
{
    /** @var float */
    protected $latitude = 0.0;
    /** @var float */
    protected $longitude = 0.0;
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
         * @link project://docs/icloud/services/find-me/init.md
         * @link project://docs/icloud/services/friends/locate-friend.md
         */

        if (is_array($json)) {
            if (isset($json["location"]) && is_array($json["location"])) {
                if (isset($json["location"]["latitude"])) {
                    $this->setLatitude((float)$json["location"]["latitude"]);
                }

                if (isset($json["location"]["longitude"])) {
                    $this->setLongitude((float)$json["location"]["longitude"]);
                }
            }

            if (isset($json["name"])) {
                $this->setName((string)$json["name"]);
            }
        }
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
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
            "latitude" => $this->getLatitude(),
            "longitude" => $this->getLongitude(),
            "name" => $this->getName()
        ];
    }
}