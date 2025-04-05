protected function addToExecList($key, \Closure $func)
    {
        $redis = $this->getRedis($key);
        $this->execList[md5(serialize($redis))][] = array(
            'key'      => $key,
            'function' => $func,
            'redis'    => $redis
        );
    }