<?php

namespace PhpDDD\Domain\Event\Listener\Locator;

use PhpDDD\Domain\Sample\Event\Listener\AllListener;
use PhpDDD\Domain\Sample\Event\Listener\InterfaceListener;
use PhpDDD\Domain\Sample\Event\Listener\OneListener;
use PhpDDD\Domain\Sample\Event\Listener\SecondListener;
use PhpDDD\Domain\Sample\Event\OneEvent;
use PhpDDD\Domain\Sample\Event\SecondEvent;
use PHPUnit_Framework_TestCase;

/**
 *
 */
class EventListenerLocatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EventListenerLocator
     */
    private $locator;

    /**
     *
     */
    public function setUp()
    {
        $this->locator = new EventListenerLocator();
    }

    /**
     * @dataProvider dataProvider
     *
     * @param array $listeners
     */
    public function testRegister(array $listeners)
    {
        if (!is_array($listeners)) {
            $listeners = array($listeners);
        }
        foreach ($listeners as $listener) {
            $this->locator->register($listener);
        }

        $this->assertTrue(true, 'command should be registered');
    }

    /**
     * @expectedException \PhpDDD\Domain\Exception\BadMethodCallException
     */
    public function testRegisterSameListenerMultipleTimes()
    {
        $this->locator->register(new AllListener());
        $this->locator->register(new AllListener());
    }

    /**
     * @dataProvider dataProvider
     *
     * @param array $listeners
     */
    public function testGetRegisteredEventListeners(array $listeners)
    {
        $this->assertEmpty($this->locator->getRegisteredEventListeners());

        foreach ($listeners as $listener) {
            $this->locator->register($listener);
        }

        $this->assertCount(count($listeners), $this->locator->getRegisteredEventListeners());
    }

    /**
     * @dataProvider dataProvider
     *
     * @param array $listeners
     * @param mixed $event
     * @param array $expectedListeners
     */
    public function testGetEventListenersForEvent(array $listeners, $event, array $expectedListeners)
    {
        foreach ($listeners as $listener) {
            $this->locator->register($listener);
        }

        $listenersForEvent = $this->locator->getEventListenersForEvent($event);
        $this->assertCount(count($expectedListeners), $listenersForEvent);
        $this->assertEquals($expectedListeners, $listenersForEvent);
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return array(
            array(
                array(new OneListener()),
                new OneEvent(),
                array(new OneListener()),
            ),
            array(
                array(new OneListener()),
                new SecondEvent(),
                array(),
            ),
            array(
                array(new InterfaceListener()),
                new OneEvent(),
                array(new InterfaceListener()),
            ),
            array(
                array(new AllListener()),
                new OneEvent(),
                array(new AllListener()),
            ),
            // multiple listener listening to separate event
            array(
                array(new OneListener(), new SecondListener()),
                new OneEvent(),
                array(new OneListener()),
            ),
            // multiple listener listening to same event
            array(
                array(new OneListener(), new AllListener()),
                new OneEvent(),
                array(new OneListener(), new AllListener()),
            ),
        );
    }
}
