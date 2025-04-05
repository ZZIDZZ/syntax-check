public function update($num_calls, $callback)
    {
        $this->completed = false;
        $this->num_calls = $num_calls;
        $this->callback = $callback;
        $this->success = true;
    }