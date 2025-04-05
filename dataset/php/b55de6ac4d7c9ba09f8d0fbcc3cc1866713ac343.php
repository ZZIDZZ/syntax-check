protected function init()
    {
        $clsname = get_called_class();
        if (property_exists($clsname, 'defaults')) {
            foreach($clsname::$defaults as $name=>$value) {
                $this->{$name} = $value;
            }
        }
        return $this;
    }