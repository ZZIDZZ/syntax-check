protected function canProceed($name, $args)
    {
        $condition = $this->condition;

        return $condition instanceof \Closure
            ? $condition($this, $name, ...$args)
            : $condition;
    }