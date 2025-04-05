public function registerCommands()
    {
        $this->add(new DirectoryAddCommand());
        $this->add(new DirectoryDeleteCommand());
        $this->add(new DownloadCommand());
        $this->add(new ExportCommand());
        $this->add(new FileAddCommand());
        $this->add(new FileDeleteCommand());
        $this->add(new FileUpdateCommand());
        $this->add(new StatusCommand());
        $this->add(new UploadTranslationCommand());
        $this->add(new DownSyncCommand());
        $this->add(new ExtractCommand());
        $this->add(new UpSyncCommand());
    }