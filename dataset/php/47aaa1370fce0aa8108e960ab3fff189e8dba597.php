public function init(Autoload $loader, $loads = []){
        $this->loader = $loader;
        foreach ($loads['namespaces'] as $prefix => $namespace) {
            $this->loader->addNamespace($prefix, ROOT . DIRECTORY_SEPARATOR . ltrim($namespace, '/'));
        }
        foreach ($loads['classes'] as $class => $path) {
            $this->loader->addClass($class, ROOT . DIRECTORY_SEPARATOR . ltrim($path, '/'));
        }
        $this->loader->register();
    }