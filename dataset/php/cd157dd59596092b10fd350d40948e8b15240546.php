public function sort($compare, bool $preserveKeys = true)
    {
        return $this->then(i\iterable_sort, $compare, $preserveKeys);
    }