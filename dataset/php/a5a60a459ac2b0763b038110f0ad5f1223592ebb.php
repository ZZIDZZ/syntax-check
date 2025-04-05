public function exec($do, array $params)
    {
        $body = call_user_func_array(array($this->operations, $do), $params);

        return $this->broadcast($body);
    }