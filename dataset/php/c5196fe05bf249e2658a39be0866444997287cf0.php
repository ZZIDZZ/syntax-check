public function resetData()
    {
        $this->data = new OrientDBData($this);
        $this->content = null;
        $this->isParsed = true;
        $this->recordPos = null;
        $this->recordID = null;
        $this->version = null;
    }