public function readSigned(&$br)
    {
        $value = $this->read($br);
        if (bccomp($value, bcpow(2, 63)) >= 0) {
            $value = bcsub($value, bcpow(2, 64));
        }

        return $value;
    }