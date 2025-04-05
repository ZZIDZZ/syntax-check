public function lookupMany($n = 1)
    {
        if ($n > $this->bufSize) {
            $this->bufSize = $n;
        }

        $this->fillBuffer();

        $tokens = [];
        $size = min($n, count($this->tokens));
        for ($i=0; $i<$size; $i++) {
            $tokens[] = $this->tokens[$i];
        }

        return $tokens;
    }