protected function executeCommand($command, OutputInterface $output = null, array $options = [])
    {
        if (is_null($output)) {
            $output = new NullOutput();
        }

        $options = array_merge($options, [
            'command' => $command,
        ]);

        $this
            ->getApplication()
            ->run(new ArrayInput($options), $output);

        return $this;
    }