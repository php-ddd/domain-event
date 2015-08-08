<?php

namespace PhpDDD\Domain\Event;

use PhpDDD\Domain\Exception\RuntimeException;

/**
 * Domain Events happen an Aggregate is modified.
 *
 * They are assumed be immutable objects that cannot change after instantiation.
 * Changing events can cause weird problems, so avoid this.
 */
interface EventInterface
{
    /**
     * @param mixed $aggregateRootId
     *
     * @throws RuntimeException When setting an aggregate id where one already exists.
     */
    public function setAggregateRootId($aggregateRootId);

    /**
     * @return mixed
     */
    public function getAggregateRootId();
}
