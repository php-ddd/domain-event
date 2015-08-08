<?php

namespace PhpDDD\Domain\Event\Listener;

use PhpDDD\Domain\Event\EventInterface;

/**
 * An event listener do some actions when a specific event is published.
 */
interface EventListenerInterface
{
    /**
     * @return string the fully qualified name of the command class that this handler can accept.
     */
    public function getSupportedEventClassName();

    /**
     * Handle the event.
     *
     * @param EventInterface $event
     *
     * @return mixed
     */
    public function handle(EventInterface $event);
}
