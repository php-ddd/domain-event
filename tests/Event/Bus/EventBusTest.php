<?php

namespace PhpDDD\Domain\Event\Bus;

use PhpDDD\Domain\Event\Listener\Locator\EventListenerLocatorInterface;
use PhpDDD\Domain\Sample\Event\Listener\AllListener;
use PhpDDD\Domain\Sample\Event\OneEvent;
use PHPUnit_Framework_TestCase;

/**
 *
 */
final class EventBusTest extends PHPUnit_Framework_TestCase
{
    public function testPublish()
    {
        $listeners   = array(new AllListener());
        $locatorMock = $this->createEventListenerLocatorMock();
        $locatorMock->expects($this->once())->method('getEventListenersForEvent')->willReturn($listeners);

        $bus = new EventBus($locatorMock);

        $result = $bus->publish(new OneEvent());
        $this->assertCount(1, $result);
        $this->assertEquals(array(null), $result);
    }

    public function testGetRegisteredEventListeners()
    {
        $listeners   = array(new AllListener());
        $locatorMock = $this->createEventListenerLocatorMock();
        $locatorMock->expects($this->once())->method('getRegisteredEventListeners')->willReturn($listeners);

        $bus = new EventBus($locatorMock);

        $this->assertEquals($listeners, $bus->getRegisteredEventListeners());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|EventListenerLocatorInterface
     */
    private function createEventListenerLocatorMock()
    {
        $mockBuilder = $this->getMockBuilder('\PhpDDD\Domain\Event\Listener\Locator\EventListenerLocator');
        $mockBuilder->setMethods(array('getEventListenersForEvent', 'getRegisteredEventListeners'));

        return $mockBuilder->getMock();
    }
//    public function testPublishEvent()
//    {
//        $event   = $this->getEventMock();
//        $locator = $this->createEventListenerLocatorMock();
//
//        $bus    = new EventBus($locator);
//        $result = $bus->publish($event);
//        $this->assertCount(1, $result);
//    }
//
//    private function getEventMock()
//    {
//        $mock = $this
//            ->getMockBuilder('\PhpDDD\Domain\Event\EventInterface')
//            ->setMockClassName('MyEvent')
//            ->getMock();
//
//        return $mock;
//    }
//
//    private function getEventListenerMock()
//    {
//        $mock = $this
//            ->getMockBuilder('\PhpDDD\Domain\Event\Listener\EventListenerInterface')
//            ->setMockClassName('EventListener')
//            ->setMethods(array('handle', 'getSupportedEventClassName'))
//            ->getMock();
//
//        $mock->expects($this->once())
//            ->method('handle')
//            ->withAnyParameters()
//            ->willReturn(false);
//
//        return $mock;
//    }
//
//    private function createEventListenerLocatorMock()
//    {
//        $mock = $this
//            ->getMockBuilder('\PhpDDD\Domain\Event\Listener\Locator\EventListenerLocator')
//            ->setMethods(array('getEventListenersForEvent'))
//            ->getMock();
//
//        $mock->expects($this->once())
//            ->method('getEventListenersForEvent')
//            ->withAnyParameters()
//            ->willReturn(array($this->getEventListenerMock()));
//
//        return $mock;
//    }
}
