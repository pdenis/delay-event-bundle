<?php

namespace Itkg\DelayEventBundle\Tests\Handler;

use Itkg\DelayEventBundle\DomainManager\LockManagerInterface;
use Itkg\DelayEventBundle\Handler\CommandLockHandler;
use Phake;
use Phake_IMock;

/**
 * Class CommandLockHandlerTest
 */
class CommandLockHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CommandLockHandler
     */
    private $handler;

    /**
     * @var LockManagerInterface|Phake_IMock
     */
    private $manager;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->manager = Phake::mock('Itkg\DelayEventBundle\DomainManager\LockManagerInterface');
        $this->handler = new CommandLockHandler($this->manager);
    }

    public function testInstance()
    {
        $this->assertInstanceOf('Itkg\DelayEventBundle\Handler\LockHandlerInterface', $this->handler);
    }

    public function testIsLocked()
    {
        $channel = 'foo';
        $lock = Phake::mock('Itkg\DelayEventBundle\Model\Lock');
        Phake::when($this->manager)->getLock($channel)->thenReturn($lock);

        Phake::when($lock)->isCommandLocked()->thenReturn(false);
        $this->assertFalse($this->handler->isLocked($channel));

        Phake::when($lock)->isCommandLocked()->thenReturn(true);
        $this->assertTrue($this->handler->isLocked($channel));
    }

    public function testLock()
    {
        $channel = 'foo';
        $lock = Phake::mock('Itkg\DelayEventBundle\Model\Lock');
        Phake::when($this->manager)->getLock($channel)->thenReturn($lock);

        $this->handler->lock($channel);
        Phake::verify($lock)->setCommandLocked(true);
        Phake::verify($this->manager)->save($lock);
    }

    public function testRelease()
    {
        $channel = 'foo';
        $lock = Phake::mock('Itkg\DelayEventBundle\Model\Lock');
        Phake::when($this->manager)->getLock($channel)->thenReturn($lock);

        $this->handler->release($channel);
        Phake::verify($lock)->setCommandLocked(false);
        Phake::verify($this->manager)->save($lock);
    }
}
