<?php

namespace PhpDDD\Domain\Event\Listener\Locator;

use PhpDDD\Domain\Event\EventInterface;
use PhpDDD\Domain\Event\Listener\EventListenerInterface;

/**
 * The purpose of this interface is to connect EventListeners to their Event.
 * You can have multiple Locator if you want to have multiple EventBus.
 */
interface EventListenerLocatorInterface
{
    /**
     * Get the list of every event listeners that want to be warn when the event specified in argument is published.
     *
     * @param EventInterface $event
     *
     * @return EventListenerInterface[]
     */
    public function getEventListenersForEvent(EventInterface $event);

    /**
     * @return EventListenerInterface[]
     */
    public function getRegisteredEventListeners();
}
