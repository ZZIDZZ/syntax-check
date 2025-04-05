final public function getMessageWithVariables(): string
    {
        if (empty($this->message)) {
            throw new \Exception(sprintf(
                'Exception %s does not have a message',
                get_class($this)
            ), Level::CRITICAL);
        }

        $message = $this->message;

        preg_match_all(self::VARIABLE_REGEX, $message, $matches);

        foreach ($matches['variable'] as $variable) {
            $variableName = substr($variable, 1, -1);

            if (!isset($this->$variableName)) {
                throw new \Exception(sprintf(
                    'Variable "%s" for exception "%s" not found',
                    $variableName,
                    get_class($this)
                ), Level::CRITICAL);
            }

            if (!is_string($this->$variableName)) {
                throw new \Exception(sprintf(
                    'Variable "%s" for exception "%s" must be a string, %s found',
                    $variableName,
                    get_class($this),
                    gettype($this->$variableName)
                ), Level::CRITICAL);
            }

            $message = str_replace($variable, $this->$variableName, $message);
        }

        return $message;
    }