protected function loadContainerConfiguration()
    {
        $configPath = $this->getConfigPath();
        $environment = $this->getEnvironment();

        $loader = new YamlFileLoader($this->container, new FileLocator($configPath));

        if (file_exists($configPath . '/' . $environment . '.yml')) {
            $loader->load($environment . '.yml');
        }

        $subEnvironment = $this->getSubEnvironment();

        if (file_exists($configPath . '/' . $environment . '.' . $subEnvironment . '.yml')) {
            $loader->load($environment . '.' . $subEnvironment . '.yml');
        }
    }