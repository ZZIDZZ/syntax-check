private function findFileWithKnownSuffix(string $pathWithoutSuffix): ?string
    {
        foreach ($this->fileSuffixes as $fileSuffix) {
            if (is_file($filePath = $pathWithoutSuffix . $fileSuffix)) {
                return $filePath;
            }
        }

        return null;
    }