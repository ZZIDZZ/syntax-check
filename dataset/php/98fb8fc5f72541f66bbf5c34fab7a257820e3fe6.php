final public function loadBundles()
    {
        $projectBundleConfig = [];
        if (is_readable($this->getConfigDir() . '/bundles.yml')) {
            $projectBundleConfig = Yaml::parse(
                file_get_contents($this->getConfigDir() . '/bundles.yml')
            );

            return $projectBundleConfig;
        }

        return $projectBundleConfig;
    }