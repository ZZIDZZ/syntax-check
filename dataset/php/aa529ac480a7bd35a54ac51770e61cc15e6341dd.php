public function handle($command): CancellablePromiseInterface
    {
        return futurePromise($this->loop, $command)->then(function ($command) {
            return resolve($this->commandBus->handle($command));
        });
    }