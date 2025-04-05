function getPlaceholder($index = null)
    {
        if (!isset($this['meta']['media']['placeholder'])) {
            return null;
        }
        if (!$this->placeholder_pick) {
            $this->placeholder_pick = rand(0, count($this['meta']['media']['placeholder']) - 1);
        }
        return $this['meta']['media']['placeholder'][$index ?: $this->placeholder_pick];
    }