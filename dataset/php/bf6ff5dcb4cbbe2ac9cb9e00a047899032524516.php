public function set($type, $key, $value, $expire = null)
    {
        $redisKey = "{$this->prefix}.$type.$key";
        $this->redis->set($redisKey, serialize($value));

        if (is_null($expire)) {
            $expire = time() + $this->lifeTime;
        }
        $this->redis->expireat($redisKey, $expire);
    }