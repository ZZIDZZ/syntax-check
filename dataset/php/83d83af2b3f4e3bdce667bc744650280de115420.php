public function setRawContent(string $rawContent): void
    {
        $this->postFields = [];
        $this->files = [];
        $this->rawContent = $rawContent;
    }