<?php

namespace PhpDDD\Domain\Sample\Event\Listener;

use PhpDDD\Domain\Event\EventInterface;
use PhpDDD\Domain\Event\Listener\AbstractEventListener;

final class OneListener extends AbstractEventListener
{
    /**
     * Get the fully qualified class name of the event class or interface this listener supports
     * If null, this listener support every events.
     *
     * @return string|null
     */
    public function getSupportedEventType()
    {
        return 'PhpDDD\\Domain\\Sample\\Event\\OneEvent';
    }

    /**
     * Handle the event.
     *
     * @param EventInterface $event
     *
     * @return mixed
     */
    public function handle(EventInterface $event)
    {
    }
}
