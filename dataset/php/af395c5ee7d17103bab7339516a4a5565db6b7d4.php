protected function _paramBackbone($key)
    {
        if (isset($this->_request['model'])) {
            $model = json_decode($this->_request['model'], true);

            return $model[$key];
        }

        return null;
    }