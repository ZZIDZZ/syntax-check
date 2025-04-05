private function loadPSRClass($class)
    {
        $prefix = $class;
        while (false !== $pos = strrpos($prefix, '\\')) {
            $prefix = substr($class, 0, $pos + 1);
            $relative_class = substr($class, $pos + 1);

            $mapped_file = $this->loadMappedFile($prefix, $relative_class);
            if ($mapped_file) {
                return $mapped_file;
            }
            $prefix = rtrim($prefix, '\\');
        }

        return false;
    }