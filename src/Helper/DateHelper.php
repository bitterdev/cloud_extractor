<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Helper;

use DateTime;

class DateHelper
{
    public function convertAppleDateTime($dateTime)
    {
        /**
         * @link project://docs/icloud/definitions/icloud/types/datetime.md
         */

        if (count($dateTime) === 7) {
            return DateTime::createFromFormat('Y-m-d H:i:s', sprintf(
                "%s-%s-%s %s:%s:00",
                $dateTime[1],
                str_pad($dateTime[2], 2, "0", STR_PAD_LEFT),
                str_pad($dateTime[3], 2, "0", STR_PAD_LEFT),
                str_pad($dateTime[4], 2, "0", STR_PAD_LEFT),
                str_pad($dateTime[5], 2, "0", STR_PAD_LEFT)
            ));
        } else {
            return new DateTime();
        }
    }

    public function convertAppleDate(string $date)
    {
        /**
         * @link project://docs/icloud/definitions/general/types/date.md
         */

        return DateTime::createFromFormat('Y-m-d', $date);
    }

    public function convertJavaScriptTimeStamp($timeStamp)
    {
        /**
         * @link project://docs/icloud/definitions/general/types/javascript-timestamp.md
         */

        $date = new DateTime();
        $date->setTimestamp($timeStamp / 1000);
        return $date;
    }

    public function convertJavaScriptDateTime(string $dateTime)
    {
        $date = new DateTime();
        $date->setTimestamp(strtotime($dateTime));
        return $date;
    }
}