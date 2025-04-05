public function moveUploadedFile($localFile, $destination)
    {
        $dir = dirname($this->baseDirectory . $destination);
        if (file_exists($localFile) && $this->ensureDirectory($dir)) {
            /**
             * we could use is_uploaded_file() and move_uploaded_file()
             * but in case of ajax uploads that would fail
             */
            if (is_readable($localFile)) {
                // rename() would be good but this is better because $localFile may become 'unwritable'
                $result = copy($localFile, $this->baseDirectory . $destination);
                @unlink($localFile);
                return $result;
            }
        }
        return false;
    }