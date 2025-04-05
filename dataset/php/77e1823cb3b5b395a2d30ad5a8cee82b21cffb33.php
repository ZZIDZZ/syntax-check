public function size($size)
    {
        if (!property_exists($this, 'sizableClass'))
        {
            throw new RuntimeException('You must specify the sizable CSS class');
        }

        $size = strtolower($size);
        if (!\in_array($size, ['lg', 'sm'], true))
        {
            throw new RuntimeException('Invalid size');
        }

        return $this->addClass("{$this->sizableClass}-$size");
    }