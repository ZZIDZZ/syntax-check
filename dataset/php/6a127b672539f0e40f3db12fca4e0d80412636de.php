private function buildEvent()
    {
        $currentEnabledStates = $this->getObject()->listEnabledStates();
        $lastEnabledStates = $this->getLastEnabledStates();

        //New state = current states - old states
        $incomingStates = \array_diff($currentEnabledStates, $lastEnabledStates);
        //Outgoing state = lst states - current states
        $outgoingStates = \array_diff($lastEnabledStates, $currentEnabledStates);

        $eventClassName = $this->eventClassName;
        $this->lastEvent = new $eventClassName($this, $incomingStates, $outgoingStates);

        return $this;
    }