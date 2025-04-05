private function throwFatalException(Throwable $e)
    {
        foreach ($this->fatalException as $exception) {
            if ($e instanceof $exception) {
                throw $e;
            }
        }
    }