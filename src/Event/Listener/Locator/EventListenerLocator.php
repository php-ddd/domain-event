<?php

namespace PhpDDD\Domain\Event\Listener\Locator;

use PhpDDD\Domain\Event\EventInterface;
use PhpDDD\Domain\Event\Listener\EventListenerCollection;
use PhpDDD\Domain\Event\Listener\EventListenerInterface;

/**
 * Implementation of EventListenerLocatorInterface.
 */
class EventListenerLocator implements EventListenerLocatorInterface
{
    /**
     * @var EventListenerCollection[]
     */
    private $listeners = array();

    /**
     * {@inheritdoc}
     */
    public function getEventListenersForEvent(EventInterface $event)
    {
        $eventClassName     = get_class($event);
        $listenerCollection = new EventListenerCollection($eventClassName);
        if (array_key_exists($eventClassName, $this->listeners)) {
            $listenerCollection = $this->listeners[$eventClassName];
        }

        return $listenerCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function getRegisteredEventListeners()
    {
        $listeners = array();
        foreach ($this->listeners as $listenerCollection) {
            $listeners[] = $listenerCollection;
        }

        return $listeners;
    }

    /**
     * @param string                 $eventClassName
     * @param EventListenerInterface $eventListener
     */
    public function register($eventClassName, EventListenerInterface $eventListener)
    {
        if (!array_key_exists($eventClassName, $this->listeners)) {
            $this->listeners[$eventClassName] = new EventListenerCollection($eventClassName);
        }
        $this->listeners[$eventClassName]->add($eventListener);
    }
}
