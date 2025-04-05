public function compute()
    {
        $product = array();

        $this->referenceSet->rewind();

        while ($this->referenceSet->valid()) {
            $product[] = $this->referenceSet->current();
            $this->referenceSet->next();
        }

        return $product;
    }