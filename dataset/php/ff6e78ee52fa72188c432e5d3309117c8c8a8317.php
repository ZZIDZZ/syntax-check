public function logQuery(string $sql, array $params = [])
    {
        if ($this->logger instanceof LoggerInterface) {
            $message = $sql . ' => ' . json_encode($params);
            $this->logger->info($message);
        }
    }