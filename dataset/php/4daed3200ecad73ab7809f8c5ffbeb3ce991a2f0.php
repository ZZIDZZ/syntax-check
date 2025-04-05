public function lists(): array
    {
        $data = [];
        foreach (array_keys($this->words) as $key) {
            $data[$key] = $this->trans($key);
        }

        return $data;
    }