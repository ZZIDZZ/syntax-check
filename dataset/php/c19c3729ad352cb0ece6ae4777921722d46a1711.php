public function setLevel($level)
    {
        if (($level < 0) || ($level > 9)) {

            throw new Zend_Filter_Exception('Level must be between 0 and 9');
        }

        $this->_options['level'] = (int) $level;
        return $this;
    }