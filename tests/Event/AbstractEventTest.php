<?php

namespace PhpDDD\Domain\Event;

use PhpDDD\Domain\Exception\RuntimeException;
use PHPUnit_Framework_TestCase;

class AbstractEventTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException RuntimeException
     */
    public function testAssigningWrongId()
    {
        $stub = $this->getMockForAbstractClass('PhpDDD\Domain\Event\AbstractEvent');
        $stub->setAggregateRootId(5);
        $this->assertTrue(true);
        $stub->setAggregateRootId(6);
    }
}
