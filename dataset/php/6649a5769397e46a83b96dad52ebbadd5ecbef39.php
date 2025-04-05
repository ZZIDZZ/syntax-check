public function finish()
    {
        assert($this->tempFile !== null);

        $file = fopen('compress.zlib://' . $this->filename, 'wb');
        rewind($this->tempFile);
        stream_copy_to_stream($this->tempFile, $file);

        fclose($file);
        fclose($this->tempFile);
        $this->tempFile = null;
    }