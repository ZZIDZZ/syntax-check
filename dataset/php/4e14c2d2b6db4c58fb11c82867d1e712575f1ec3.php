private function calculateFilePath($certificateChainUri)
    {
        $filename = md5($certificateChainUri);

        $path = $this->filePath.$filename;

        return $path;
    }