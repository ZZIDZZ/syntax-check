protected function callRepository($resource)
    {
        $repositoryName = $this->getRepositoryName($resource);

        if ($this->confirm("Do you want me to create a $repositoryName Repository? [yes|no]"))
        {
            $this->call('generate:repository', compact('repositoryName'));
        }
    }