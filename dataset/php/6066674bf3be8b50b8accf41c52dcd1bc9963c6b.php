protected function merge($original, $merge)
    {
        if (is_array($original) && is_array($merge)) {
            return array_merge($original, $merge);
        }

        if (is_array($original)) {
            foreach ($merge as $key => $value) {
                $original[$key] = $value;
            }
        } else {
            foreach ($merge as $key => $value) {
                $original->$key = $value;
            }
        }

        return $original;
    }