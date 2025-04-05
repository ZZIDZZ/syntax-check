public function get($key) {
        if(!$this->exists($key)) {
            return false;
        }

        return array_get($this->items, $key);
    }