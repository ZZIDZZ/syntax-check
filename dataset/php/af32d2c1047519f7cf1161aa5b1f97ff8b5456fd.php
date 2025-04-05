protected function _initConfig(array $options)
    {
        $options = array_filter($options, function ($option) {
            return null !== $option;
        });

        $this->_config = new Data(array_merge($this->_default, $options));
    }