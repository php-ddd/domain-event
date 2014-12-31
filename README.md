
Domain
======

This library allows you to concentrate to what matters most in your application: the domain.  
According to Eric Evan's book Domain-Driven Design, your domain should be composed of aggregate.  
Each aggregate is composed by an AggregateRoot and possibly some ObjectValue.

This library focus on the AggregateRoot and provides helper to manage Event happening to your aggregate.

Usage
-----

An example will better explain the purpose of this library:

```php
use PhpDDD\Domain\AbstractAggregateRoot;

class PurchaseOrder extends AbstractAggregateRoot
{
    /**
     * @var mixed
     */
    private $customerId;

    /**
     * Try to create a new PurchaseOrder for a client.
     */
    public function __construct(Customer $customer)
    {
        // Tests that some business rules are followed.
        if (false === $customer->isActive()) {
            throw new MyDomainException('The customer need to be active.');
        }
        
        // ...
        // Since every rules are validated, we can simulate the creation of the Event associated
        // This allows us to have less redundant code
        
        $this->apply(new PurchaseOrderCreated($customer, new DateTime()));
        
        // This is equivalent as
        // $this->customerId = $customer->getId();
        // $this->events[] = new PurchaseOrderCreated($customer, new DateTime());
        // but we are not allowing to add event directly.
    }
    
    /**
     * The apply() method will automatically call this method.
     * Since it's an event you should never do some tests in this method.
     * Try to think that an Event is something that happened in the past.
     * You can not modify what happened. The only thing that you can do is create another event to compensate.
     */
    protected function applyPurchaseOrderCreated(PurchaseOrderCreated $event)
    {
        $this->customerId = $event->getCustomer()->getId();
    }
}
```

What's good with this approach is that you can then listen to every events produced by your AggregateRoot and do some
additional stuff that is not really relevant to your business domain like sending an email.

```php
use PhpDDD\Domain\Event\Listener\AbstractEventListener;

class SendEmailOnPurchaseOrderCreated extends AbstractEventListener
{
    private $mailer;
    
    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getSupportedEventClassName()
    {
        return 'PurchaseOrderCreated'; // Should be the fully qualified class name of the event
    }
    
    /**
     * {@inheritDoc}
     */
    public function handle(EventInterface $event)
    {
        $this->mailer->send('to@you.com', 'Purchase order created for customer #' . $event->getCustomer()->getId());
    }
}
```

For your project to know that an EventListener is bound to the Event, you should use the EventBus:


```php
// first the locator
$locator = new \PhpDDD\Domain\Event\Listener\Locator\EventListenerLocator();
$locator->register('PurchaseOrderCreated', new SendEmailOnPurchaseOrderCreated(/* $mailer */));

// then the EventBus
$bus = new \PhpDDD\Domain\Event\Bus\EventBus($locator);

// do what you need to do on your Domain
$aggregateRoot = new PurchaseOrder(new Customer(1));

// Then apply EventListeners
$events = $aggregateRoot->pullEvents(); // this will clear the list of event in your AggregateRoot so an Event is trigger only once

// You can have more than one event at a time.
foreach($events as $event) {
    $bus->publish($event);
}
```
