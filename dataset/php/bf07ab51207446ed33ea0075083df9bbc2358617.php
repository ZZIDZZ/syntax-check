protected function send($data)
    {
        $this->log('-> ' . $data, self::VERBOSITY_ALL);
        fwrite($this->stdout, $data);
        fflush($this->stdout);
        return $this;
    }