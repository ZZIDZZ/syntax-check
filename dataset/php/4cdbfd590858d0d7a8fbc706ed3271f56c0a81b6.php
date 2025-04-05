public function apply($domainEvent)
    {
        $domainEvent = $this->ensureDomainEvent($domainEvent);
        $eventHandlerName = $this->getEventHandlerName($domainEvent);
        if (method_exists($this, $eventHandlerName)) {
            $this->executeEventHandler($this, $eventHandlerName, $domainEvent);
        } else {
            $this->applyRecursively($eventHandlerName, $domainEvent);
        }
    }