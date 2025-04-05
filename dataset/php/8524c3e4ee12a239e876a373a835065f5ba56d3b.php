public function getPoint($name)
    {
        return isset($this->_points[$name]) ? $this->_points[$name] : null;
    }