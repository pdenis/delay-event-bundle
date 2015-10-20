<?php

namespace Itkg\DelayEventBundle\Document;

use Gedmo\Timestampable\Traits\TimestampableDocument;
use Itkg\DelayEventBundle\Model\Event as BaseEvent;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class Event
 *
 * @ODM\Document(
 *   repositoryClass="Itkg\DelayEventBundle\Repository\EventRepository",
 *   collection="event"
 * )
 * @ODM\DiscriminatorField(fieldName="type")
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 */
class Event extends BaseEvent
{
    use TimestampableDocument;

    /**
     * @var string
     *
     * @ODM\id
     */
    protected $id;

    /**
     * @var string
     *
     * @ODM\String
     */
    protected $originalName;

    /**
     * @var bool
     *
     * @ODM\Boolean
     */
    protected $async = true;
}
