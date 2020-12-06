<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Object;

use App\Enumeration\ReminderPriority;
use App\Helper\DateHelper;
use JsonSerializable;
use DateTime;

class Reminder implements JsonSerializable
{
    /** @var DateTime */
    protected $dueDate;
    /** @var string */
    protected $title = '';
    /** @var string */
    protected $description = '';
    /** @var int */
    protected $priority = ReminderPriority::LOW;
    /** @var DateHelper */
    protected $dateHelper;

    public function __construct(
        DateHelper $dateHelper
    )
    {
        $this->dateHelper = $dateHelper;
        $this->dueDate = new DateTime();
    }

    public function createFromJson($json = null)
    {
        /**
         * Parse JSON and create object.
         *
         * @link project://docs/icloud/services/reminders/get-reminders.md
         */

        if (is_array($json)) {
            if (isset($json["dueDate"])) {
                $this->setDueDate($this->dateHelper->convertAppleDateTime($json["dueDate"]));
            }

            if (isset($json["title"])) {
                $this->setTitle((string)$json["title"]);
            }

            if (isset($json["description"])) {
                $this->setDescription((string)$json["description"]);
            }

            if (isset($json["priority"])) {
                $this->setPriority((int)$json["priority"]);
            }
        }
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "dueDate" => $this->getDueDate()->format("c"),
            "title" => $this->getTitle(),
            "description" => $this->getDescription(),
            "priority" => $this->getPriority()
        ];
    }
}