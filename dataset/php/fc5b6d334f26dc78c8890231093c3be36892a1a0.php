public function isCalled($hookName)
    {
        $hookName = $this->sanitize($hookName);
        if (!$hookName || ! isset($this->actions[$hookName])) {
            return 0;
        }

        return $this->actions[$hookName];
    }