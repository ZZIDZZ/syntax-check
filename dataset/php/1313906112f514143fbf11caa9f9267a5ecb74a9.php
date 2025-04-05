private function createLogger($channel, array $config)
    {
        // Setup configuration
        // Use default laravel logs path
        $storagePath = $this->app->make('path.storage');
        $filepath = $storagePath . '/logs/' . $config['stream'];

        $logger = new Logger($channel);
        $handler = new StreamHandler($filepath);

        // Daily rotation
        if ($config['daily']) {
            $handler = new RotatingFileHandler($filepath, 1);
        }

        // Format line
        if (isset($config['format'])) {
            $format = $config['format'];
            $handler->setFormatter(new LineFormatter($format['output'], $format['date']));
        }

        $logger->pushHandler($handler);

        $this->channels[$channel] = $logger;
    }