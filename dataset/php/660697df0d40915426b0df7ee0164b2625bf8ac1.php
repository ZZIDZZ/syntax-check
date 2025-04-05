public function getManipulations()
    {
        $manipulations = array_map(function ($key) {
            return $key . '_' . $this->manipulations[$key];
        }, array_keys($this->manipulations ?: []));

        return implode(',', $manipulations);
    }