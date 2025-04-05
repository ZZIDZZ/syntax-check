public function fire()
    {
        $handle = popen(PHP_BINDIR.'/pecl install wxwidgets 2>&1', 'r');

        while ( ! feof($handle)) { 
            $this->output->write(fread($handle, 2048));
        }
    }