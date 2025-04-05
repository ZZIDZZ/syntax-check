private function autoHash()
    {
        $attributes = array_merge(static::$needsHash, array('password'));

        foreach ($attributes as $name) {

            if (isset($this->attributes[$name]) && $this->isDirty($name))
            {
                if ( ! Hash::check($this->attributes[$name], $this->getOriginal($name))) 
                {
                    $this->attributes[$name] = Hash::make($this->attributes[$name]);                
                }
            }
        }
    }