public function boot()
    {
        $this->publishes([
            implode(DIRECTORY_SEPARATOR, [__DIR__, 'config', 'api.php']) => config_path('api.php')
        ]);

        $this->setupRoutes($this->app->router);
    }