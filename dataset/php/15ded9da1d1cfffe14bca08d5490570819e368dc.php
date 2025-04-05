protected function registerLogger()
    {
        $this->app->singleton('logger', function (Container $app) {
            $loggers = [];

            foreach ($app->config->get('logger.loggers', []) as $logger => $levels) {
                $loggers[] = new LevelAwareLogger($app->make($logger), (array) $levels);
            }

            return new LoggerWrapper($loggers);
        });

        $this->app->alias('logger', LoggerWrapper::class);
        $this->app->alias('logger', LoggerInterface::class);
        $this->app->alias('logger', Log::class);
    }