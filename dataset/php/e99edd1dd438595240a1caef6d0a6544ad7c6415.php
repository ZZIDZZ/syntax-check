public function cloneEarlyRunner()
    {
        $ret          = clone $this;
        $ret->nextRun = time();
        $this->once   = true;
        
        //\mdebug('Cloned early runner for process [%d]', $this->currentPid);
        
        return $ret;
    }