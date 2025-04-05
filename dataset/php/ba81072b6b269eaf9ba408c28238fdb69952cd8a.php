protected function fromDocblock($docblock, array $context=array())
    {
        $annotations = $this->getParser()->parse($docblock);

        $col = $this->getCollection();
        $rv = array();
        foreach ($annotations as $annot) {
            list($name, $positional, $named) = $annot;

            if ($obj = $col->create($name, $positional, $named, $context)) {
                $rv[] = $obj;
            }
        }

        return $rv;
    }