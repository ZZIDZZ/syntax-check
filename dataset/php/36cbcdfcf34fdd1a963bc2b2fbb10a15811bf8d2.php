public function extractPath($path)
    {
        if ($path && method_exists($this, 'setPath')) {
            $this->setPath($path);
        }

        if (!$path && method_exists($this, 'getPath')) {
            $path = $this->getPath();
        }

        if (!$path) {
            throw new InvalidArgumentException('Missing path argument.');
        }

        return $path;
    }