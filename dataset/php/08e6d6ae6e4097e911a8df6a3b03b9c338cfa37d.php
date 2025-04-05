final private function verifySort(array $sort, string $label, array &$completeFields)
    {
        foreach ($sort as $key => $value) {
            $this->throwIfTrue(!is_string($key), "key in \${$label} was not a string");
            $this->throwIfTrue(
                $value !== 1 && $value !== -1,
                "value of \${$label} is not 1 or -1 for ascending and descending"
            );

            $completeFields["payload.{$key}"] = $value;
        }
    }