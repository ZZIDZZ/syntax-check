public function readDecimal() {
        $scale = $this->readInt();
        $value = $this->readVarint();
        $len = strlen($value);
        return substr($value, 0, $len - $scale) . '.' . substr($value, $len - $scale);
    }