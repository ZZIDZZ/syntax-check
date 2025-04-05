public function filter($predicate) {
        if (!is_callable($predicate)) {
            throw new Exception("Can't call Some#filter with a non callable.");
        }
        if ($predicate($this->_value)) {
            return $this;
        } else {
            return new None();
        }
    }