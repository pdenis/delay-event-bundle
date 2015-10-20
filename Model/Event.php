<?php

namespace Itkg\DelayEventBundle\Model;

use Symfony\Component\EventDispatcher\Event as BaseEvent;

/**
 * Class Event
 */
class Event extends BaseEvent
{
    /**
     * @var string
     */
    protected $originalName;

    /**
     * @var bool
     */
    protected $delayed = true;

    /**
     * @param bool $delayed
     */
    public function __construct($delayed = true)
    {
        $this->delayed = $delayed;
    }
    /**
     * @return boolean
     */
    public function isDelayed()
    {
        return $this->delayed;
    }

    /**
     * @param boolean $delayed
     *
     * @return $this
     */
    public function setDelayed($delayed)
    {
        $this->delayed = $delayed;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * @param string $originalName
     *
     * @return $this
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }
}
