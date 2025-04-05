public function fetch($id)
    {
        $id = $this->getCompletedCacheIdIfValid($id);

        return $this->backend->doFetch($id);
    }