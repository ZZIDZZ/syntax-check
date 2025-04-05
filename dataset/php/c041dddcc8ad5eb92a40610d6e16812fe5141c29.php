public function runProcess(Process $process, $memory)
    {
        try {
            $process->run(function ($type, $line) {
                $this->handleWorkerOutput($type, $line);
            });
        }catch (\Exception $e){
            dd($e);
        }

        // If we caught a signal and need to stop gracefully, this is the place to
        // do it.
        pcntl_signal_dispatch();
        if ($this->stopGracefully){
            $this->gracefulStop();
        }
        // Once we have run the job we'll go check if the memory limit has been
        // exceeded for the script. If it has, we will kill this script so a
        // process manager will restart this with a clean slate of memory.
        if ($this->memoryExceeded($memory)) {
            $this->stop();
        }
    }