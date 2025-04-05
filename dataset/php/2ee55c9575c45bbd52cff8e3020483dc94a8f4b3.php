protected function setup()
    {
        $autoloader = $this->decode($this->filename);
        if (null === $autoloader) {
            throw new InvalidJsonFormatException(sprintf('The json file %s is malformed. Please check the file syntax to fix the problem', $this->filename));
        }

        if (empty($autoloader["bundles"])) {
            throw new InvalidJsonFormatException(sprintf('The json file %s requires the bundles section. Please add that section to fix the problem', $this->filename));
        }

        foreach ($autoloader["bundles"] as $bundleClass => $options) {
            $environments = (isset($options["environments"])) ? $options["environments"] : 'all';
            if (!is_array($environments)) $environments = array($environments);
            $overrides = (isset($options["overrides"])) ? $options["overrides"] : array();
            $bundle = new Bundle();
            $bundle
                ->setClass($bundleClass)
                ->setOverrides($overrides)
            ;
            foreach ($environments as $environment) {
                $this->bundles[$environment][] = $bundle;
            }
        }

        if (isset($autoloader["actionManager"])) {
            $this->actionManagerClass = $autoloader["actionManager"];
        }

        if (isset($autoloader["routing"])) {
            $this->routing = $autoloader["routing"];
        }
    }