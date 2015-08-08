<?php

namespace PhpDDD\Domain\Event\Listener\Locator;

use PhpDDD\Domain\Event\Listener\EventListenerInterface;
use PHPUnit_Framework_TestCase;

class EventListenerLocatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EventListenerLocator
     */
    private $locator;

    public function setUp()
    {
        $this->locator = new EventListenerLocator();
    }

    public function testRegister()
    {
        $this->locator->register('MyEvent', $this->getEventListenerMock());
        $this->assertTrue(true, 'command should be registered');
    }

    public function testRegisterMultipleListenerForOneEvent()
    {
        $this->locator->register('MyEvent', $this->getEventListenerMock());
        $this->locator->register('MyEvent', $this->getEventListenerMock());

        $collections = $this->locator->getRegisteredEventListeners();
        $this->assertEquals(2, count($this->locator->getEventListenersForEvent($this->getEventMock())));
        $this->assertEquals(1, count($collections));
        $this->assertEquals(2, count(reset($collections)));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|EventListenerInterface
     */
    private function getEventListenerMock()
    {
        $mock = $this
            ->getMockBuilder('\PhpDDD\Domain\Event\Listener\EventListenerInterface')
            ->setMethods(array('getSupportedEventClassName', 'handle'))
            ->getMock();

        $mock->expects($this->once())
            ->method('getSupportedEventClassName')
            ->willReturn('MyEvent');

        return $mock;
    }

    private function getEventMock()
    {
        $mock = $this
            ->getMockBuilder('\PhpDDD\Domain\Event\EventInterface')
            ->setMockClassName('MyEvent')
            ->getMock();

        return $mock;
    }
}
