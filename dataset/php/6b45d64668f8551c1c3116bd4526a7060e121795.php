public function close(): void
    {
        $this->pos      = $this->current      = 0;
        $this->seekable = true;

        foreach ($this->streams as $stream) {
            $stream->close();
        }

        $this->streams = [];
    }