<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Enumeration;

abstract class Endpoint
{
    const IDMSA = "idmsa";
    const SETUP = "setup";
    const CALENDAR = "calendar";
    const CONTACTS = "contacts";
    const DATABASE = "ckdatabasews";
    const DOCUMENTS = "docws";
    const DRIVE = "drivews";
    const FIND_ME = "findme";
    const MAIL = "mail";
    const REMINDERS = "reminders";
}