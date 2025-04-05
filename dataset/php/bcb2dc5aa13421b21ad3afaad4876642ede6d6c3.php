protected static function others(FileManager $fileManager, array &$parameters)
    {
        if (in_array(
            static::explain($parameters, 'Do you want to create Model layer?', '[y/n]'),
            static::POSITIVES)
        ) {
            $fileManager->execute('model');
        }
        if (in_array(
            static::explain($parameters, 'Do you want to create Repository layer?', '[y/n]'),
            self::POSITIVES
        )) {
            $fileManager->execute('repository');
        }
    }