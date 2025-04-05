public function kill()
    {
        $lock_data = $this->getStatus();
        if ($lock_data === false)
            return null;

        return posix_kill($lock_data->pid, SIGKILL);
    }