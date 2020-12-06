<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class LoginEvent extends Event
{
    public const NAME = 'icloud.login';
}