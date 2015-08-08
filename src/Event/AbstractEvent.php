<?php

namespace PhpDDD\Domain\Event;

use PhpDDD\Domain\Event\Utils\EventName;
use PhpDDD\Domain\Exception\RuntimeException;

abstract class AbstractEvent implements EventInterface
{
    /**
     * @var mixed
     */
    private $aggregateRootId;

    /**
     * @param mixed $aggregateRootId
     *
     * @throws RuntimeException When setting an aggregate id where one already exists.
     */
    public function setAggregateRootId($aggregateRootId)
    {
        if (null !== $this->aggregateRootId && $aggregateRootId !== $this->aggregateRootId) {
            $eventName = new EventName($this);
            throw new RuntimeException(
                sprintf(
                    'Event %s: The aggregate root id is already set and is different from the one given.',
                    $eventName
                )
            );
        }

        $this->aggregateRootId = $aggregateRootId;
    }

    /**
     * @return mixed
     */
    public function getAggregateRootId()
    {
        return $this->aggregateRootId;
    }
}
