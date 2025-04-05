public function addAttachment($file, $forceFileName = '', $forceMimeType = '')
    {
        $this->attachments[] = array(
            'file' => $file,
            'fileName' => $forceFileName,
            'mimeType' => $forceMimeType,
        );

        return $this;
    }