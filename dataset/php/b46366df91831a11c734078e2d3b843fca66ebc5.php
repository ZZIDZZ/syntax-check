protected function free(Throwable $exception = null)
    {
        $this->poll->free();

        if (null !== $this->await) {
            $this->await->free();
        }

        while (!$this->readQueue->isEmpty()) {
            /** @var \Icicle\Awaitable\Delayed $delayed */
            $delayed = $this->readQueue->shift();
            $delayed->resolve();
        }

        while (!$this->writeQueue->isEmpty()) {
            /** @var \Icicle\Awaitable\Delayed $delayed */
            list( , , , $delayed) = $this->writeQueue->shift();
            $delayed->reject(
                $exception = $exception ?: new ClosedException('The datagram was unexpectedly closed.')
            );
        }
    }