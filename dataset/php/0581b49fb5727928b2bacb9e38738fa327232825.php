protected function getExceptionFromContext(array $context)
    {
        $exception = $context['exception'] ?? null;

        if ($exception instanceof \Exception) {
            return $exception;
        }

        if ($exception instanceof \Error) {
            return new \ErrorException(
                $exception->getMessage(),
                0,
                $exception->getCode(),
                $exception->getFile(),
                $exception->getLine()
            );
        }

        return null;
    }