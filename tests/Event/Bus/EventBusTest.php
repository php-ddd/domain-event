<?php

namespace PhpDDD\Domain\Event\Bus;

use PHPUnit_Framework_TestCase;

class EventBusTest extends PHPUnit_Framework_TestCase
{
    public function testPublishEvent()
    {
        $event   = $this->getEventMock();
        $locator = $this->createEventListenerLocatorMock();

        $bus    = new EventBus($locator);
        $result = $bus->publish($event);
        $this->assertCount(1, $result);
    }

    private function getEventMock()
    {
        $mock = $this
            ->getMockBuilder('\PhpDDD\Domain\Event\EventInterface')
            ->setMockClassName('MyEvent')
            ->getMock();

        return $mock;
    }

    private function getEventListenerMock()
    {
        $mock = $this
            ->getMockBuilder('\PhpDDD\Domain\Event\Listener\EventListenerInterface')
            ->setMockClassName('EventListener')
            ->setMethods(array('handle', 'getSupportedEventClassName'))
            ->getMock();

        $mock->expects($this->once())
            ->method('handle')
            ->withAnyParameters()
            ->willReturn(false);

        return $mock;
    }

    private function createEventListenerLocatorMock()
    {
        $mock = $this
            ->getMockBuilder('\PhpDDD\Domain\Event\Listener\Locator\EventListenerLocator')
            ->setMethods(array('getEventListenersForEvent'))
            ->getMock();

        $mock->expects($this->once())
            ->method('getEventListenersForEvent')
            ->withAnyParameters()
            ->willReturn(array($this->getEventListenerMock()));

        return $mock;
    }
}
