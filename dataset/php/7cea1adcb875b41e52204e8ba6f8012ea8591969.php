public function clearMessageData()
    {
        $this->clear(self::ADBACK_MESSAGE_SCRIPT);
        $this->clear(self::ADBACK_MESSAGE_URL);
        $this->clear(self::ADBACK_MESSAGE_CODE);
    }