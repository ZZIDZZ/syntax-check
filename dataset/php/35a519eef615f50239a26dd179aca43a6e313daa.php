protected function loadUrl(string $jsonFile): array
    {
        //Get real path of file
        if (($fileName = realpath($jsonFile)) === false) {
            throw new NotFoundException(sprintf('File "%s" not found', $jsonFile));
        }

        // Read file
        if (($json = @file_get_contents($fileName)) === false) {
            throw new ConfigException(sprintf('Unable to load configuration file "%s"', $fileName));
        }

        try {
            return $this->loadJson($json);
        } catch (ConfigException $e) {
            throw new ConfigException(sprintf('Not a valid JSON data for file "%s"', $fileName));
        }
    }