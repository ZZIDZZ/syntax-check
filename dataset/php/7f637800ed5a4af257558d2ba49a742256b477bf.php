public function getShortMessage()
    {
        $msg = $this->getMessage();
        if (\strpos($msg, '(): ') !== false) {
            list(, $msg) = \explode('(): ', $msg);
        }

        return $msg;
    }