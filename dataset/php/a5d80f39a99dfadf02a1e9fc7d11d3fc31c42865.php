public function close()
    {
        if (is_resource($this->resource)) {
            fclose($this->resource);
        }

        $this->resource = null;
        $this->autoClose = false;
    }