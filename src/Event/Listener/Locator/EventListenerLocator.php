<?php

namespace PhpDDD\Domain\Event\Listener\Locator;

use PhpDDD\Domain\Event\EventInterface;
use PhpDDD\Domain\Event\Listener\EventListenerInterface;
use PhpDDD\Domain\Exception\BadMethodCallException;
use PhpDDD\Utils\ClassUtils;

/**
 * Implementation of EventListenerLocatorInterface.
 */
class EventListenerLocator implements EventListenerLocatorInterface
{
    /**
     * @var EventListenerInterface[]
     */
    private $listeners = array();

    /**
     * {@inheritdoc}
     */
    public function getEventListenersForEvent(EventInterface $event)
    {
        $filteredListeners = array();
        foreach ($this->listeners as $listener) {
            if (true === $listener->isListeningTo($event)) {
                $filteredListeners[] = $listener;
            }
        }

        return $filteredListeners;
    }

    /**
     * {@inheritdoc}
     */
    public function getRegisteredEventListeners()
    {
        return $this->listeners;
    }

    /**
     * @param EventListenerInterface $eventListener
     */
    public function register(EventListenerInterface $eventListener)
    {
        $canonicalName = ClassUtils::getCanonicalName($eventListener);
        if (array_key_exists($canonicalName, $this->listeners)) {
            throw new BadMethodCallException('You can not register the same event listener more than once.');
        }
        $this->listeners[$canonicalName] = $eventListener;
    }
}
