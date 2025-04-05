protected function publishStream(StreamInterface $stream): EventStoreRepository
    {
        foreach ($stream as $domainEventMessage) {
            $this
                ->getEventPublisher()
                ->publish($domainEventMessage);
        }

        return $this;
    }