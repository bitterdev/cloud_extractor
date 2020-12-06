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

class Event implements JsonSerializable
{
    /** @var string */
    protected $title = '';
    /** @var bool */
    protected $allDay = false;
    /** @var DateTime */
    protected $startDate;
    /** @var DateTime */
    protected $endDate;
    /** @var DateHelper */
    protected $dateHelper;

    public function __construct(
        DateHelper $dateHelper
    )
    {
        $this->dateHelper = $dateHelper;
        $this->startDate = new DateTime();
        $this->endDate = new DateTime();
    }

    public function createFromJson($json = null)
    {
        /**
         * Parse JSON and create object.
         *
         * @link project://docs/icloud/services/calendar/get-events.md
         */

        if (is_array($json)) {
            if (isset($json["title"])) {
                $this->setTitle((string)$json["title"]);
            }

            if (isset($json["allDay"])) {
                $this->setAllDay((bool)$json["allDay"]);
            }

            if (isset($json["startDate"])) {
                $this->setStartDate($this->dateHelper->convertAppleDateTime($json["startDate"]));
            }

            if (isset($json["endDate"])) {
                $this->setEndDate($this->dateHelper->convertAppleDateTime($json["endDate"]));
            }
        }
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

    public function isAllDay()
    {
        return $this->allDay;
    }

    public function setAllDay($allDay)
    {
        $this->allDay = $allDay;
        return $this;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'title' => $this->getTitle(),
            'allDay' => $this->isAllDay(),
            'start' => $this->getStartDate()->format("c"),
            'end' => $this->getEndDate()->format("c")
        ];
    }
}