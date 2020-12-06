<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Collection;

use App\Helper\DateHelper;
use App\Object\Reminder;
use JsonSerializable;
use ArrayAccess;
use SeekableIterator;
use Countable;

class Reminders implements JsonSerializable,  ArrayAccess, SeekableIterator, Countable
{
    /** @var DateHelper */
    protected $dateHelper;
    /** @var int */
    protected $position = 0;
    /** @var Reminder[] */
    protected $items = [];

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
         * @link project://docs/icloud/services/reminders/get-reminders.md
         */

        if (is_array($json)) {
            if (isset($json["Reminders"]) && is_array($json["Reminders"])) {
                foreach ($json["Reminders"] as $field) {
                    if (isset($field["title"])) {
                        $reminder = new Reminder($this->dateHelper);
                        $reminder->createFromJson($field);
                        $this->add($reminder);
                    }
                }
            }
        }
    }

    public function jsonSerialize()
    {
        return $this->items;
    }

    public function add($value, $key = '')
    {
        if (strlen($key) === 0) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    public function delete($key)
    {
        unset($this->items[$key]);
    }

    public function exists($key)
    {
        return isset($this->items[$key]);
    }

    public function get($key)
    {
        return $this->items[$key];
    }

    public function offsetExists($offset)
    {
        return $this->exists($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->add($value, $offset);
    }

    public function offsetUnset($offset)
    {
        $this->delete($offset);
    }

    public function current()
    {
        return $this->items[$this->position];
    }

    public function next()
    {
        ++$this->position;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return isset($this->items[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function seek($position)
    {
        if (isset($this->items[$position])) {
            $this->position = $position;
        }
    }

    public function count()
    {
        return count($this->items);
    }
}