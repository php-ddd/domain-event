<?php

namespace PhpDDD\Domain\Event\Listener;

use PhpDDD\Domain\Event\EventInterface;

/**
 *
 */
abstract class AbstractEventListener implements EventListenerInterface
{
    /**
     * Get the fully qualified class name of the event class or interface this listener supports
     * If null, this listener support every events.
     *
     * @return string|null
     */
    abstract public function getSupportedEventType();

    /**
     * @param EventInterface $event
     *
     * @return bool true if the listener wants to handle the given event, false otherwise
     */
    public function isListeningTo(EventInterface $event)
    {
        $supportedEvent = $this->getSupportedEventType();
        if (null === $supportedEvent) {
            return true;
        }

        return $event instanceof $supportedEvent;
    }
}
