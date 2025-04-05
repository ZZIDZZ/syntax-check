protected function registerFactory(): void
    {
        $this->app->singleton('hashids.factory', function () {
            return new HashidsFactory();
        });

        $this->app->alias('hashids.factory', HashidsFactory::class);
    }