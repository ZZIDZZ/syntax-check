protected function _createIterationException(
        $message = null,
        $code = null,
        RootException $previous = null,
        IterationInterface $iteration = null
    ) {
        return new IterationException($message, $code, $previous, $iteration);
    }