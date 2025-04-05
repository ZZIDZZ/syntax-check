public function delete($key)
    {
        if ($this->isSafe() && !empty($key)) {
            return $this->client->delete($key);
        }

        return false;
    }