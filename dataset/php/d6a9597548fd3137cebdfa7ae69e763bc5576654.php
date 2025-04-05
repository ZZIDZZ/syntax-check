public function getHydratorClass() : string
    {
        $originalClassName = $this->configuration->getHydratedClassName();
        $realClassName = $this->generateClassName($originalClassName);

        if (!class_exists($realClassName)) {

            $directory = $directory = $this->configuration->getGeneratedClassesTargetDir();
            $targetFile = $directory . '/' . \str_replace("\\", "_", $realClassName) . '.php';

            if (@include_once $targetFile) {
                return $realClassName;
            }

            $generator = $this->configuration->getHydratorGenerator();
            $phpClassCode = $generator->generate(new \ReflectionClass($originalClassName), $realClassName, $originalClassName);
            $this->writeFile($targetFile, $phpClassCode);

            require_once $targetFile;
        }

        return $realClassName;
    }