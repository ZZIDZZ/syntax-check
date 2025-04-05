private function executeProcess()
    {
        $command = $this->compileCommand();
        exec($command, $result, $status);
        if ($status > 0) {
            throw new Exceptions\ExecutionException('Unknown error occurred when attempting to execute: ' . $command . PHP_EOL);
        }
        return $result;
    }