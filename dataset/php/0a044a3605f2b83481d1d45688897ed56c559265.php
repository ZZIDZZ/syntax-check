protected function bootConfig()
    {
        $path = __DIR__ . '/config/pricing.php';

        $this->mergeConfigFrom($path, 'pricing');

        if (function_exists('config_path')) {
            $this->publishes([$path => config_path('pricing.php')]);
        }
    }