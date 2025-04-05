private function deathByCamels($string)
    {
        $this->index = 0;
        return implode('', array_map(function($el) {
            $this->index++;
            return $this->index === 1 ? $el : ucfirst($el);
        }, explode(' ', str_replace('_', ' ', $string))));
    }