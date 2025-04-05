public function random($prefix = ''){
            $key = $prefix.$this->create().strval(rand(strlen($_SERVER['REMOTE_ADDR']), rand(111,2222)));
            $uniqid = uniqid($key);
            return md5($uniqid);
        }