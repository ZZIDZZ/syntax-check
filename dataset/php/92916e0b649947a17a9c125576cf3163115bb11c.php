public function get(?string $key = null)
    {
        if (is_null($key)) {
            return $this->metadata;
        }

        if (! array_key_exists($key, $this->metadata)) {
            return null;
        }

        return $this->metadata[$key];
    }