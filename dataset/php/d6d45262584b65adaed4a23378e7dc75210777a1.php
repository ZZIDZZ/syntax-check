public function getLine()
    {
        return (feof($this->fp)) ? false : fgets($this->fp, $this->lineReadLength);
    }