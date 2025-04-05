public function tokenize($input, $finalize = true) {
        try {
            return call_user_func($this->_tokenize, $input, $finalize);
        } catch (\Exception $e) {
            throw $e;
        }
    }