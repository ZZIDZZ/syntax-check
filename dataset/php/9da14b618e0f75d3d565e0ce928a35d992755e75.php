public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $response = self::execute($this->callable, [$request, $handler]);
        if (!$response instanceof ResponseInterface) {
            throw new UnexpectedValueException(
                sprintf('The middleware must return an instance of %s', ResponseInterface::class)
            );
        }
        return $response;
    }