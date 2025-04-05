public function read()
    {
        $size = shmop_size($this->shmid);
        $data = shmop_read($this->shmid, 0, $size);

        return $data;
    }