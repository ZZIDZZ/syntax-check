private function registerCommands()
    {
        $this->add(new ScanCommand());
        $this->add(new ExplainCommand());
        $this->add(new WarmUpCommand());
        $this->add(new CustomCommand());
    }