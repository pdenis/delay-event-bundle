<?php

namespace Itkg\DelayEventBundle\Model;

/**
 * Class Lock
 */
class Lock
{
    /**
     * @var bool
     */
    protected $commandLocked = false;

    /**
     * @var string
     */
    protected $channel = '';

    /**
     * @return boolean
     */
    public function isCommandLocked()
    {
        return $this->commandLocked;
    }

    /**
     * @param boolean $commandLocked
     *
     * @return $this
     */
    public function setCommandLocked($commandLocked)
    {
        $this->commandLocked = $commandLocked;

        return $this;
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param string $channel
     *
     * @return Lock
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;

        return $this;
    }
}
