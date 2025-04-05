public function invoke($from = null, $keyword = null, $to = null, $text = '')
    {
        if(!$from) {
            throw new Exception("\$from parameter cannot be blank");
        }

        if(!$keyword) {
            throw new Exception("\$keyword parameter cannot be blank");
        }

        if(!$to) {
            throw new Exception("\$to parameter cannot be blank");
        }

        if(!$text) {
            throw new Exception("\$text parameter cannot be blank");
        }

        return $this->exec([
            'from' => $from,
            'keyword' => $keyword,
            'to' => $to,
            'text' => $text
        ]);
    }