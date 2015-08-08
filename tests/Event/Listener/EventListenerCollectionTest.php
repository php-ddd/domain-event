<?php

namespace PhpDDD\Domain\Event\Listener;

use PhpDDD\Domain\Exception\RuntimeException;
use PHPUnit_Framework_TestCase;

class EventListenerCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testAddEventListenerForGoodEvent()
    {
        $mock = $this
            ->getMockBuilder('PhpDDD\Domain\Event\Listener\EventListenerInterface')
            ->setMethods(array('getSupportedEventClassName', 'handle'))
            ->getMock();

        $mock->expects($this->once())
            ->method('getSupportedEventClassName')
            ->willReturn('GoodEvent');

        $collection = new EventListenerCollection('GoodEvent');
        $collection->add($mock);
        $this->assertEquals(1, count($collection->getIterator()));
        $this->assertEquals('GoodEvent', $collection->getEventName());
    }

    /**
     * @expectedException RuntimeException
     */
    public function testAddEventListenerForWrongEvent()
    {
        $mock = $this
            ->getMockBuilder('PhpDDD\Domain\Event\Listener\EventListenerInterface')
            ->setMethods(array('getSupportedEventClassName', 'handle'))
            ->getMock();

        $mock->expects($this->once())
            ->method('getSupportedEventClassName')
            ->willReturn('WrongEvent');

        $collection = new EventListenerCollection('event');
        $collection->add($mock);
    }
}
