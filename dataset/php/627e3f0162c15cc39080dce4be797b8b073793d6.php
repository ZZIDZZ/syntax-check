public function getArgs($strict = false, $force = false)
    {
        if (is_null($this->args) || $force) {
            $this->args = new \cli\Arguments($strict);
            $this->args->addFlag(array(
                'verbose',
                'v'
            ), 'Turn on verbose output');
            $this->args->addFlag('version', 'Display the version');
            $this->args->addFlag(array(
                'help',
                'h'
            ), 'Show this help screen');
        }
        
        return $this->args;
    }