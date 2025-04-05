public function run()
    {
        // Start timing
        $this->_startTime();

        // Get next task with set priority (or any task if priority not set)
        if (null === ($task = $this->getQueue()->getTask($this->getPriority()))) {
            $this->_sleep();
            return;
        }

        $event = new Event($this);
        $event->setArgument('startTime', $this->_startTime);
        $event->setTask($task);
        
        $this->getQueue()->getEventDispatcher()->dispatch(self::EVENT_START_PROCESSING_TASK, $event);
        
        $this->_runTask($task);
        
        $event = new Event($this);
        $event->setArgument('elapsedTime', $this->_getPassedTime());
        $event->setTask($task);
        
        $this->getQueue()->getEventDispatcher()->dispatch(self::EVENT_END_PROCESSING_TASK, $event);

        // After working, sleep
        $this->_sleep();

        return $task;
    }