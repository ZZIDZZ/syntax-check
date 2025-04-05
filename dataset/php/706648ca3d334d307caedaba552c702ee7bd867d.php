protected function getClassReflection(SplFileInfo $file, $namespace, $suffix, $parent, $allowedParameters)
    {
        // Determine the fully-qualified class name of the found file.
        $class = preg_replace('#\\\\{2,}#', '\\', sprintf(
            '%s\\%s\\%s',
            $namespace,
            strtr($file->getRelativePath(), '/', '\\'),
            $file->getBasename($this->extension)
        ));
        // Make sure that the class name has the correct suffix.
        if (!empty($suffix) && substr($class, 0 - strlen($suffix)) !== $suffix) {
            throw new \LogicException(sprintf(
                'The file found at "%s" does not end with the required suffix of "%s".',
                $file->getRealPath(),
                $suffix
            ));
        }
        // We have to perform a few checks on the class before we can return it.
        // - It must be an actual class; not interface, abstract or trait types.
        // - For this to work the constructor must not have more than the expected number of required parameters.
        // - And finally make sure that the class loaded was actually loaded from the directory we found it in.
        //   TODO: Make sure that the final (file path) check doesn't cause problems with proxy classes or
        //         bootstraped/compiled class caches.
        $reflect = new ReflectionClass($class, $file->getRelativePath());
        if ((is_object($construct = $reflect->getConstructor())
                && $construct->getNumberOfRequiredParameters() > $allowedParameters
            )
            || $reflect->isAbstract() || $reflect->isInterface() || $reflect->isTrait()
            || (is_string($parent) && !empty($parent) && !$reflect->isSubclassOf($parent))
            || $reflect->getFileName() !== $file->getRealPath()
        ) {
            throw new \LogicException(sprintf('The class definition for "%s" is invalid.', $class));
        }
        return $reflect;
    }