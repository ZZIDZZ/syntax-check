private function createFilename(string $name): string
    {
        $name = Inflector::tableize($name);

        $filename = sprintf(self::FILENAME_FORMAT,
            date(self::TIMESTAMP_FORMAT),
            $this->chunkID++,
            $name
        );

        return $this->files->normalizePath(
            $this->config->getDirectory() . FilesInterface::SEPARATOR . $filename
        );
    }