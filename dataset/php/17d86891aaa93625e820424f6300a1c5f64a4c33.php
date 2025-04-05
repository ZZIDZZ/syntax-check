function handleStreamClose(\CharlotteDunois\Phoebe\Worker $worker) {
        $this->messenger->removeWorkerSocket($worker);
        $this->removeWorker($worker);
        
        $this->emit('exitWorker', $worker);
    }