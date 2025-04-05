public function loadGenerators()
    {
        // Reset the list of loaded classes
        $this->generators = array ();

        // Loop through each registered path
        foreach ($this->generatorPaths as $generatorPrefix => $generatorPath) {
            // Build the iterators to search the path
            $dirIterator = new \RecursiveDirectoryIterator($generatorPath);
            $iteratorIterator = new \RecursiveIteratorIterator($dirIterator);
            $generatorIterator = new \RegexIterator($iteratorIterator, '/^.+\.php$/i');

            // Loop through the iterator looking for GeneratorInterface
            // instances
            foreach ($generatorIterator as $generatorFile) {
                // Determine additional namespace from file path
                $pathName = $generatorFile->getPath();
                if (substr($pathName, 0, strlen($generatorPath)) == $generatorPath) {
                    $pathName = substr($pathName, strlen($generatorPath), strlen($pathName));
                }

                // Best guess for class name is Prefix\Path\File
                $class = $generatorPrefix . '\\' . $pathName . $generatorFile->getBasename('.php');
                $class = str_replace('/', '\\', $class);

                // If the class doesn't exists and isn't autoloaded, try to
                // load it from the discovered file.
                if (!class_exists($class, true) && !in_array($generatorFile->getPathName(), get_included_files())) {
                    include $generatorFile->getPathname();
                }

                // If the class exists and implements GeneratorInterface,
                // append it to our list.
                if (class_exists($class, false) && in_array(__NAMESPACE__ . '\\GeneratorInterface', class_implements($class))) {
                    if ($class::isSupported()) {
                        $this->generators[] = $class;
                    }
                }
            }
        }
    }