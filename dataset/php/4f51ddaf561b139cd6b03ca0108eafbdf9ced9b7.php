final public function dispatch($name, EventInterface $event)
    {
        if ($this->hasDispatcher()) {
            $this->getDispatcher()->dispatch($name, $event);
            return true;
        }
        return false;
    }