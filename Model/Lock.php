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
}
