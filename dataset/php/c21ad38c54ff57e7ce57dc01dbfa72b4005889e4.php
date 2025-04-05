public function getContentType(): string
    {
        if (empty($this->content_type) && !empty($this->file)) {
            $this->content_type = $this->getMimeType($this->file);
        }

        return $this->content_type;
    }