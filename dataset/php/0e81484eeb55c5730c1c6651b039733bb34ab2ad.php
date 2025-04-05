public function send($batchid)
    {
        if (empty($batchid)) {
            throw new \InvalidArgumentException("Batch Id must not be empty");
        }

        $data = [
            'username' => $this->username,
            'password' => $this->password,
            'batch_id' => $batchid,
        ];

        return $this->curl->get($this->getUrl(), $data);
    }