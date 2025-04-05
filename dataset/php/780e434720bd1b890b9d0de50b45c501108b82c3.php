public function logCommand($command, $duration, $connection, $error = false)
    {
        ++$this->commandCount;

        if (null !== $this->logger) {
            $this->commands[] = [
                'cmd' => $command,
                'executionMS' => $duration,
                'conn' => $connection,
                'error' => $error
            ];

            if ($error) {
                $this->logger->error('Command "' . $command . '" failed (' . $error . ')');
            } else {
                $this->logger->debug('Executing command "' . $command . '"');
            }
        }
    }