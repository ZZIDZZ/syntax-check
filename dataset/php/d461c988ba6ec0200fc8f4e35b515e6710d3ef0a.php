protected function loadAutoloaderFile(string $filePath): void
    {
        $filePath = $this->finder->resolveExtensionPath($filePath);

        if ($this->files->isFile($filePath)) {
            $this->files->getRequire($filePath);
        }
    }