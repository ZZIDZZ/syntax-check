public function executeCommand($command, array $input, $decorators = [])
    {
        $command = $this->mapInputToCommand($command, $input);

        $bus = $this->getCommandBus();

        // If any decorators are passed, we'll
        // filter through and register them
        // with the CommandBus, so that they
        // are executed first.
        foreach ($decorators as $decorator) {
            $bus->decorate($decorator);
        }

        return $bus->execute($command);
    }