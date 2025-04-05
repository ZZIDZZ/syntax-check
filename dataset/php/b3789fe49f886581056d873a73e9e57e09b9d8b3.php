public function search($params = array())
    {
        return $this->adapter->fetch($this->toSql(), array_merge($this->params(), $this->params(true), $params));
    }