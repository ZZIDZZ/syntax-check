public function getOption($name)
    {
        $name = strtolower($name);

        if ($name == 'tag_cache') {
            return $this->getInnerCache();
        }

        return parent::getOption($name);
    }