protected function dispatchEvent($name, Event $event)
    {
        if ($this->dispatcher) {
            $this->dispatcher->dispatch($name, $event);
        }
    }