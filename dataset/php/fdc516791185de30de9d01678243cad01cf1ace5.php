protected function readFile()
    {

        $fileExtension = pathinfo($this->filePath, PATHINFO_EXTENSION);
        if ($fileExtension != 'yml' && $fileExtension != 'yaml')
            throw new InvalidConfigurationException(sprintf(
                    'Could not use "%s" - only yml files are supported by AssetsVersionManager',
                    var_export($this->versionValue, true)
                ));

        try {
            $this->fileContents = file_get_contents($this->filePath);
        } catch (\Exception $e) {
            throw new FileException(sprintf(
                    'Could not read file "%s"; make sure it exists and you have enough permissions',
                    $this->filePath
                ));
        }

        // Find a row with the parameter
        preg_match(
                '/(\s+' . $this->parameterName . '\:[^\S\n]*)(' . static::$versionValueMask . ')\s*(\n|#)/',
                $this->fileContents . "\n",
                $matches
            );

        if (array_key_exists(2, $matches)) {
            $this->versionValue = $matches[2];
            $this->versionStartPos = strpos($this->fileContents."\n", $matches[0]) + strlen($matches[1]);
            return;
        }

        throw new \Exception(sprintf(
                'Could not find definition of parameter "%s"; make sure it exists in "%s"',
                $this->parameterName,
                $this->filePath
            ));
    }