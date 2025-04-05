protected function getEventListeners($event = null): array
    {
        $eventManager = $this->getEventManager();

        return $event !== null && !$eventManager->hasListeners($event) ? [] : $eventManager->getListeners($event);
    }