protected function msg($msg, array $params = []) {
        return array_key_exists($msg, $this->messages) ? vsprintf($this->messages[$msg], $params) : null;
    }