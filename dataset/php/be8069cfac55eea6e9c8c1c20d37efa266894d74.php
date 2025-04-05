private function checking() : void
    {
        $cleared = ! ($this->cIdleCount() + $this->cBusyCount());

        if ($this->exiting) {
            if ($this->pool && ($closed = $this->pool->closed())->pended() && $cleared) {
                $closed->resolve();
            }
            return;
        }

        $cleared && $this->resizing(
            max(
                1,
                $this->options->initial,
                min($this->getWaitQ->count(), $this->options->maxIdle)
            ),
            'minimum-scaling'
        );
    }