public function linkLayers()
    {
        for ($i = 1; $i < count($this->structure); $i++) {
            $this->layers[$i]->bind($this->layers[$i - 1]);
        }
    }