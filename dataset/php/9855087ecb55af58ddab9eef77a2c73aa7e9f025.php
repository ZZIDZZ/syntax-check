protected function getMigrationToFileMap() {
        if (null === $this->_migrationToFileMap) {
            $files = array();

            $this->msg('Load application migrations from ' . $this->migrationPath);
            $paths = array(
                $this->migrationPath,
            );
            if (!$this->module) {
                $paths = array_merge($paths, $this->getModulesMigrationPaths());
            }
            foreach ($paths as $migrationPath) {
                $moduleFiles = $this->getMigrationFiles($migrationPath);
                $files = array_merge($files, $moduleFiles);
            }
            $this->_migrationToFileMap = $files;
        }
        return $this->_migrationToFileMap;
    }