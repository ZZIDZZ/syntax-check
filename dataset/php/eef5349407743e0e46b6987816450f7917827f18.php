public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        $array = [];

        foreach ($this->data as $key => $value) {
            if ($recursive && is_array($value)) {
                $array[$key] = (new ArrayObject($value))->toArray([], [], $recursive);
            } else {
                $array[$key] = $value;
            }
        }

        return $array;
    }