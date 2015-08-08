<?php

namespace PhpDDD\Domain;

use BadMethodCallException;
use PhpDDD\Domain\Event\EventInterface;
use PhpDDD\Domain\Event\Utils\EventName;

/**
 * An AggregateRoot is the starting point of an Aggregate.
 * It's the only class from an Aggregate that should be known by the outside world.
 */
abstract class AbstractAggregateRoot
{
    /**
     * @var int
     */
    protected $id;

    /**
     * List of events that occurred.
     *
     * @var EventInterface[]
     */
    private $events = array();

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * This allows you to get every events raised by the aggregate and clear the stack.
     * It's helpful when you do event sourcing because once an event is raised you may need to do some actions in other
     * bounded contexts. So the events is fired once.
     *
     * @return EventInterface[]
     */
    public function pullEvents()
    {
        $this->safelyPopulateEventsWithAggregateId();
        $events       = $this->events;
        $this->events = array();

        return $events;
    }

    /**
     * Used when somebody is trying to modify an Aggregate.
     * You should check that the input is good then create an event and call this method.
     *
     * @param EventInterface $event
     */
    protected function apply(EventInterface $event)
    {
        $this->executeEvent($event);
        $this->events[] = $event;
    }

    /**
     * @param EventInterface $event
     *
     * @throws BadMethodCallException
     */
    private function executeEvent(EventInterface $event)
    {
        $eventName = new EventName($event);
        $method    = sprintf('apply%s', (string) $eventName);

        if (!method_exists($this, $method)) {
            throw new BadMethodCallException(
                sprintf(
                    'You must define the %s::%s method(%s $event) in order to apply event named "%s". ',
                    get_class($this),
                    $method,
                    get_class($event),
                    $eventName
                )
            );
        }

        $this->$method($event);
    }

    /**
     *
     */
    private function safelyPopulateEventsWithAggregateId()
    {
        foreach ($this->events as $event) {
            if (null === $event->getAggregateRootId()) {
                $event->setAggregateRootId($this->id);
            }
        }
    }
}
