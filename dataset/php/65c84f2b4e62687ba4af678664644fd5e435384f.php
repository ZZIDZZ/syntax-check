protected function write(array $keys, $expire = 1)
    {
        foreach ($keys as $k => $v) {
            $k = sha1($k);
            $this->redis->setex($k, $expire, $v);
        }
        return true;
    }