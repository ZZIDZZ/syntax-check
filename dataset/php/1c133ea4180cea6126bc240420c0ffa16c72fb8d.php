protected function initializeInstallDir($packageType)
    {
        $installDir = '';

        $rootPackageExtra = $this->rootPackage ? $this->rootPackage->getExtra() : null;
        if (!empty($rootPackageExtra[$packageType . '-dir'])) {
            $installDir = rtrim($rootPackageExtra[$packageType . '-dir'], '/\\');
        }

        if (!$installDir) {
            if (empty($this->installDirs[$packageType])) {
                throw new \InvalidArgumentException(
                    "The package type '" . $packageType . "' is not supported"
                );
            }

            $installDir = $this->installDirs[$packageType];
        }

        if (!$this->filesystem->isAbsolutePath($installDir)) {
            $installDir = dirname($this->vendorDir) . '/' . $installDir;
        }

        $this->filesystem->ensureDirectoryExists($installDir);
        return realpath($installDir);
    }