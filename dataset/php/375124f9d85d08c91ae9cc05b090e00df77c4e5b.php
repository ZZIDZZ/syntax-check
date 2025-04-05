protected function getPossibleFiles($name)
    {
        return array_map(function($extension) use ($name) {
            return str_replace('.', '/', $name).'.'.$extension;
        }, $this->extensions);
    }