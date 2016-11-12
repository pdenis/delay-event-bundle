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
     * @var \DateTime
     */
    protected $lockedAt;

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

        if ($commandLocked) {
            $this->lockedAt = new \DateTime();
        } else {
            $this->lockedAt = null;
        }
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

    /**
     * @return \DateTime
     */
    public function getLockedAt()
    {
        return $this->lockedAt;
    }
}
