public function daemon($sleep = 60, $memoryLimit = 128)
    {
        $memoryLimit = $memoryLimit * 1024 * 1024;
        $startTime = time();
        while (true) {
            $ret = $this->runNextJob();

            if (! $ret) { //没有获取到job
                sleep($sleep);
            }

            ($this->memoryExceeded($memoryLimit) || $this->queueShouldRestart($startTime)) &&
                $this->stop();
        }
    }