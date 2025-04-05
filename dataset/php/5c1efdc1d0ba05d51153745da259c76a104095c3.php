private function checkDataAttribute($name, $default, array $available)
    {
        $item = $this->getItem($name);

        if ( ! is_null($item)) {
            $item = (is_string($item) and in_array($item, $available))
                ? strtolower(trim($item))
                : $default;

            $this->setItem($name, $item);
        }
    }