<?php

namespace PhpDDD\Domain;

use PhpDDD\Domain\Event\AbstractEvent;
use PhpDDD\Domain\Exception\BadMethodCallException;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

class AbstractAggregateRootTest extends PHPUnit_Framework_TestCase
{
    public function testPullEmptyEvents()
    {
        $stub = $this->getMockForTestedClass();

        $events = $stub->pullEvents();
        $this->assertEmpty($events);
    }

    public function testPullOneEvent()
    {
        $aggregate = new ConcreteAggregateRoot();
        $events    = $aggregate->pullEvents();
        $this->assertEquals(1, count($events));
        $this->assertInstanceOf('PhpDDD\Domain\ConcreteCreated', reset($events));
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testWrongEvent()
    {
        $aggregate = new ConcreteAggregateRoot();
        $aggregate->add();
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|AbstractAggregateRoot
     */
    private function getMockForTestedClass()
    {
        return $this->getMockForAbstractClass('PhpDDD\Domain\AbstractAggregateRoot');
    }
}

class ConcreteAggregateRoot extends AbstractAggregateRoot
{
    public function __construct()
    {
        $this->apply(new ConcreteCreated());
    }

    public function add()
    {
        $this->apply(new WrongEvent());
    }

    public function applyConcreteCreated(ConcreteCreated $event)
    {
        // do nothing
    }
}

class ConcreteCreated extends AbstractEvent
{
}
class WrongEvent extends AbstractEvent
{
}
