<?php

namespace PhpDDD\Domain\Event\Listener;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use PhpDDD\Domain\Exception\RuntimeException;

class EventListenerCollection implements IteratorAggregate, Countable
{
    /**
     * @var string
     */
    private $eventName;

    /**
     * @var EventListenerInterface[]
     */
    private $eventListeners = array();

    /**
     * @param string $eventName
     */
    public function __construct($eventName)
    {
        $this->eventName = $eventName;
    }

    /**
     * @return EventListenerInterface[]
     */
    public function getIterator()
    {
        return new ArrayIterator($this->eventListeners);
    }

    /**
     * @return string
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * @param EventListenerInterface $eventListener
     */
    public function add(EventListenerInterface $eventListener)
    {
        if ($eventListener->getSupportedEventClassName() !== $this->eventName) {
            throw new RuntimeException(
                sprintf(
                    'EventListener %s does not support event %s.',
                    get_class($eventListener),
                    $this->eventName
                )
            );
        }

        $this->eventListeners[] = $eventListener;
    }

    /**
     * @return int The custom count as an integer.
     */
    public function count()
    {
        return count($this->eventListeners);
    }
}
