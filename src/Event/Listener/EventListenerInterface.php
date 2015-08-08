<?php

namespace PhpDDD\Domain\Event\Listener;

use PhpDDD\Domain\Event\EventInterface;

/**
 * An event listener do some actions when a specific event is published.
 */
interface EventListenerInterface
{
    /**
     * @param EventInterface $event
     *
     * @return bool true if the listener wants to handle the given event, false otherwise
     */
    public function isListeningTo(EventInterface $event);

    /**
     * Handle the event.
     *
     * @param EventInterface $event
     *
     * @return mixed
     */
    public function handle(EventInterface $event);
}
