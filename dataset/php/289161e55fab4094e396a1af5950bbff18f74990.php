public function kill()
    {
        if ($this->isRunning()) {
            $processId = $this->getProcessId();

            if (OperatingSystem::isWindows()) {
                $cmd = "taskkill /pid {$processId} -t -f";
            } else {
                $cmd = "kill -9 {$processId}";
            }

            shell_exec($cmd);
        }

        return $this;
    }