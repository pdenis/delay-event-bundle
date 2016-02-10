<?php

namespace Itkg\DelayEventBundle\DomainManager;

use Itkg\DelayEventBundle\Model\Lock;

/**
 * Interface LockManagerInterface
 */
interface LockManagerInterface
{
    /**
     * @param Lock $Lock
     */
    public function save(Lock $Lock);

    /**
     * @param Lock $Lock
     */
    public function delete(Lock $Lock);

    /**
     * @return Lock
     */
    public function createNew();

    /**
     * @param string $channel
     *
     * @return Lock
     */
    public function getLock($channel);
}
