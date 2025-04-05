public function getNamespace()
    {
        if (! is_null($this->namespace)) {
            return $this->namespace;
        }
        $path = $this->basePath;
        $composer = json_decode(file_get_contents($path.DIRECTORY_SEPARATOR.'composer.json'), true);

        foreach ((array) data_get($composer, 'autoload.psr-4') as $namespace => $path) {
            return $this->namespace = $namespace;
        }

        throw new RuntimeException('Unable to detect application namespace.');
    }