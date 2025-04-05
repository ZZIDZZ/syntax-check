protected function log(LogOperation $log)
    {
        $message = $this->getLogMessage($log);

        if (!is_null($log->getError())) {
            $this->logger->error($message);
        } else {
            $this->logger->debug($message);
        }
    }