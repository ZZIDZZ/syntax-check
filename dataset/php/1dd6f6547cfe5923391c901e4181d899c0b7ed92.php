public function callbackGrimReaper(TimerInterface $caller)
    {
        $connection = $caller->getData();

        $this->getLogger()->debug('CTCP PING timeout reached, closing connection');
        $this->getEventQueueFactory()->getEventQueue($connection)->ircQuit();
    }