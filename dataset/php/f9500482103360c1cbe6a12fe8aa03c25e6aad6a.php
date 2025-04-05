protected function findTransition(Execution $execution)
    {
        $out = (array) $execution->getProcessModel()->findOutgoingTransitions($execution->getNode()->getId());
        $trans = null;
        
        if ($this->transitionId === null) {
            if (count($out) != 1) {
                throw new \RuntimeException(sprintf('No single outgoing transition found at node "%s"', $execution->getNode()->getId()));
            }
            
            return array_pop($out);
        }
        
        foreach ($out as $tmp) {
            if ($tmp->getId() === $this->transitionId) {
                $trans = $tmp;
                
                break;
            }
        }
        
        if ($trans === null) {
            throw new \RuntimeException(sprintf('Transition "%s" not connected to node "%s"', $this->transitionId, $execution->getNode()->getId()));
        }
        
        return $trans;
    }