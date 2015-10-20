<?php

namespace Itkg\DelayEventBundle\Processor;

use Itkg\DelayEventBundle\Model\Event;

/**
 * Class EventProcessorInterface
 */
interface EventProcessorInterface
{
    /**
     * @param Event $event
     */
    public function process(Event $event);
}
