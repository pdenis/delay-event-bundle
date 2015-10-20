<?php

namespace Itkg\DelayEventBundle\DomainManager;

use Itkg\DelayEventBundle\Model\Event;

/**
 * interface EventManagerInterface
 */
interface EventManagerInterface
{
    /**
     * @param Event $event
     */
    public function save(Event $event);

    /**
     * @param Event $event
     */
    public function delete(Event $event);
}
