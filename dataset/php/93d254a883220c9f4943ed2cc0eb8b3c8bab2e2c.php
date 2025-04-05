protected function copyLessFolders()
    {
        foreach ($this->lessSources as $source => $destination) {

            $this->line('<info>LESS:</info> ' . base_path($destination));

            File::copyDirectory(
                base_path($source),
                base_path($destination)
            );
        }
    }