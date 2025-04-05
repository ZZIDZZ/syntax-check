private function loadFromIterator(\Iterator $iterator)
    {
        /* @var \SplFileInfo[] $iterator */
        foreach ($iterator as $file) {
            if ($file->getFilename() === 'fixtures.yml') {
                $this->addFixture($file->getPathname());
            }
        }
    }