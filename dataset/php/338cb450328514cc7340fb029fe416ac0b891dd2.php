public function addIterator(iterable $iterator, PagesInterface $pages = null): void
    {
        foreach ($iterator as $filename) {
            $this->addFile($filename, $pages);
        }
    }