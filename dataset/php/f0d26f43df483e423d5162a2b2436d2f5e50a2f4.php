public function combineFiles($combinedFileName, $files, $options = array())
    {
        $new_files = [];

        foreach ($files as $file) {
            $new_files[] = $this->processLessFile($file);
        }

        return parent::combineFiles($combinedFileName, $new_files, $options);
    }