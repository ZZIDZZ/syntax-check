public function filter(array $objects, $expression)
    {
        $filteredObjects = [];

        foreach ($objects as $key => $object) {
            try {
                if (@$this->language->evaluate('object.'.$expression, ['object' => $object])) {
                    $filteredObjects[] = $object;
                }
            } catch (\Exception $exception) {
                // Property does not exist: ignore this item
            }
        }

        return $filteredObjects;
    }