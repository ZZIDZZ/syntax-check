public function locateAll($command)
    {
        return array_values(array_filter($this->_pathBuilder->getPermutations($command), $this->_executableTester));
    }