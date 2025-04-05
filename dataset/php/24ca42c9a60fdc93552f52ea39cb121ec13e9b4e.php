private function currentCommandCheck()
    {
        $this->params['update'] = true;
        if ($this->currentCommand === null) {
            $this->currentCommand = new Command();
        }

    }