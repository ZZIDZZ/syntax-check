public function delete()
    {
        if (file_exists($this->filename)) {
            unlink($this->filename);
        }
        $this->hit = false;
        $this->value = null;
        return $this;
    }