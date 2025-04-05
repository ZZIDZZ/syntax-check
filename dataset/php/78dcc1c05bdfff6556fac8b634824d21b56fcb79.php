protected function setWpFolderName()
    {
        $dirs = explode('/', $this->wpDirectoryPath);

        $this->wpFolderName = $dirs[count($dirs) - 2];
    }