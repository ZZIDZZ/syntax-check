public function getConsole(Container $app = null)
    {
        return $this->console ?: (isset($app['console']) ? $app['console'] : new Console());
    }