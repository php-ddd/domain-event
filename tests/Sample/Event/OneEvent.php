<?php

namespace PhpDDD\Domain\Sample\Event;

use PhpDDD\Domain\Exception\RuntimeException;

/**
 *
 */
final class OneEvent implements OneEventInterface
{
    /**
     * @param mixed $aggregateRootId
     *
     * @throws RuntimeException When setting an aggregate id where one already exists.
     */
    public function setAggregateRootId($aggregateRootId)
    {
    }

    /**
     * @return mixed
     */
    public function getAggregateRootId()
    {
    }
}
