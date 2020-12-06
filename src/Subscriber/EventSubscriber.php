<?php

/**
 * @project:   Cloud Explorer
 *
 * @author     Fabian Bitter <fabian@bitter.de>
 * @copyright  (C) 2020 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

/** @noinspection ALL */

namespace App\Subscriber;

use App\Event\LoginEvent;
use App\Event\LogoutEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            LoginEvent::NAME => 'onLogin',
            LogoutEvent::NAME => 'onLogout'
        ];
    }

    public function onLogin(LoginEvent $event)
    {
        // Do Nothing
    }

    public function onLogout(LogoutEvent $event)
    {
        // Do Nothing
    }
}