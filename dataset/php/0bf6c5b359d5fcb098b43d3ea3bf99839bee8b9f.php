public function resetLimit($limitStart = null, $limitEnd = null)
    {
        $this->_limit = '';
        if ($limitStart !== null) {
            $this->limit($limitStart, $limitEnd);
        }

        return $this;
    }