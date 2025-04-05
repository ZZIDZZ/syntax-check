public function addReplytos(array $reply_tos)
    {
        foreach ($reply_tos as $key => $val) {
            if (is_numeric($key)) {
                $this->addReplyto($val);
            } else {
                $this->addReplyto($key, $val);
            }
        }
    }