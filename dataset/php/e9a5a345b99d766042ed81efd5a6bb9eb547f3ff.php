protected function isValidUpload()
    {
        $error = $this->error ?: UPLOAD_ERR_NO_FILE;

        switch ($error) {
            case UPLOAD_ERR_OK:
                return $this->isUploadedFile();
                break;

            case UPLOAD_ERR_INI_SIZE:
                throw new \RuntimeException('The uploaded file exceeds the upload_max_filesize directive in php.ini');
                break;

            case UPLOAD_ERR_FORM_SIZE:
                throw new \RuntimeException('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form');
                break;

            case UPLOAD_ERR_PARTIAL:
                throw new \RuntimeException('The uploaded file was only partially uploaded');
                break;

            case UPLOAD_ERR_NO_FILE:
                throw new \RuntimeException('No file was uploaded');
                break;

            case UPLOAD_ERR_NO_TMP_DIR:
                throw new \RuntimeException('Missing a temporary folder');
                break;

            case UPLOAD_ERR_CANT_WRITE:
                throw new \RuntimeException('Failed to write file to disk');
                break;

            case UPLOAD_ERR_EXTENSION:
                throw new \RuntimeException('A PHP extension stopped the file upload');
                break;

            default:
                throw new \RuntimeException('Invalid error code');
                break;
        }
    }