public function finalize()
    {
        if ($this->finalized) {
            return;
        }

        $befores = [];
        $afters = [];

        foreach ($this->getGroups() as $group) {
            $befores = array_merge($befores, $group->before());
            $afters  = array_merge($group->after(), $afters);
        }
        
        $befores = array_merge($befores, $this->before());
        $afters  = array_merge($this->after(), $afters);

        // before kernel
        foreach ($befores as $middleware) {
            $this->pushToBefore($middleware);
        }
        // after kernel
        foreach ($afters as $middleware) {
            $this->pushToAfter($middleware);
        }

        $this->finalized = true;
    }