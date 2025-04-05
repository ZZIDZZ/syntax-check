public function addRecord(String $domain, int $ttl, String $recordType, String $value) {
        return $this->manage($domain, $ttl, $recordType, $value);
    }