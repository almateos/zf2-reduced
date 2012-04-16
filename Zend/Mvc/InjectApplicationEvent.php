<?php

namespace Zend2\Mvc;

use Zend2\EventManager\EventDescription as Event;

interface InjectApplicationEvent
{
    public function setEvent(Event $event);
    public function getEvent();
}
