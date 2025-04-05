public function matches(array $data)
    {
        foreach ($this->filters as $filter) {
            if ($filter($data)) {
                return true;
            }
        }

        return false;
    }