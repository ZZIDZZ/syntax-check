private function updateData($data)
    {
        $this->data = $data;

        $cache = Yii::$app->{$this->cache};
        $cache->delete($this->cacheName);

        if (is_array($this->data) && count($this->data)) {
            $cache->set($this->cacheName, serialize($this->data));
        }
    }