public function svg($name = '', $class = '', $attrs = [])
    {
        if (empty($name)) {
            return;
        }

        return sage(SvgFactory::class)->svg($name, $class, $attrs);
    }