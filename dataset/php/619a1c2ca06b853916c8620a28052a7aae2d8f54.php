public function setExplicit($setting = 'yes')
    {
        if (in_array($setting, $this->explicitTypes)) {
            $this->defaultOptions['explicit'] = $setting;
        }

        return $this;
    }