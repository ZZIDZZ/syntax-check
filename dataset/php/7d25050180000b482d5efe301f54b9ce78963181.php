public function getOption($key)
    {
        $value = '';
        try {
            $value = $this->options[$key];
        } catch (\Exception $e) {
        }

        return $value;
    }