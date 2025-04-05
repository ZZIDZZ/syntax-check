protected function enforceStorageLimit()
    {
        if ($this->storageLimit < 1) {
            return;
        }

        // $storage must be an array or implement Countable and Traversable
        if (!is_array($this->storage)
            && !($this->storage instanceof Countable && $this->storage instanceof Traversable)
        ) {
            return;
        }

        if (is_array($this->storage)) {
            while (count($this->storage) > $this->storageLimit) {
                array_shift($this->storage);
            }
        } else {
            // array_shift() doesn't work for ArrayAccess, so we need an iterator in order to use rewind()
            // and key(), so that we can then unset
            $iterator = $this->storage;
            if ($this->storage instanceof \IteratorAggregate) {
                $iterator = $this->storage->getIterator();
            }
            while (count($this->storage) > $this->storageLimit) {
                $iterator->rewind();
                unset($this->storage[$iterator->key()]);
            }
        }
    }