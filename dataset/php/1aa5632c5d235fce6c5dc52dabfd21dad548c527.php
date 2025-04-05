protected function createApplication()
    {
        putenv('APP_ENV=' . $this->getEnv());

        if (!is_a($this->appClassName, App::class, true)) {
            throw new Exception("Instance of Pixelindustries\\PhpspecTestbench\\App expected, got {$this->appClassName}.");
        }

        return (new $this->appClassName)->createApplication();
    }