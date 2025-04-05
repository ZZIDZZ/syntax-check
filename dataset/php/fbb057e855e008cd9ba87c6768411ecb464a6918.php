public function flush(
        $command,
        array $streams,
        array &$pipes = [],
        $cwd = null,
        array $env = null,
        array $options = []
    ) {
        $process = proc_open($command, $streams, $pipes, $cwd, $env, $options);
        if (!is_resource($process)) {
            throw new \RuntimeException('Error to open the process');
        }
        return proc_close($process);
    }