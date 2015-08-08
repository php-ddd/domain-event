<?php

namespace PhpDDD\Domain\Event\Utils;

use PhpDDD\Domain\Event\EventInterface;

/**
 * slugify an Event class name in order to display a nicer name than the FQCN.
 */
final class EventName
{
    /**
     * @var EventInterface
     */
    private $event;

    /**
     * @var string
     */
    private $name;

    /**
     * @param EventInterface $event
     */
    public function __construct(EventInterface $event)
    {
        $this->event = $event;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if ($this->name === null) {
            $this->name = $this->parseName();
        }

        return $this->name;
    }

    /**
     * @return string
     */
    private function parseName()
    {
        $class = get_class($this->event);

        if ('Event' === substr($class, -5)) {
            $class = substr($class, 0, -5);
        }

        if (false === strpos($class, '\\')) {
            return $class;
        }

        $parts = explode('\\', $class);

        return end($parts);
    }
}
