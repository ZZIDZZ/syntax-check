public function setDataType($type)
    {
        $types = array('integer', 'string', 'string');

        $shorthand = array('int', 'varchar', 'text');

        $index = array_search($type, $shorthand);

        $this->type = $index === false ? $type : $types[$index];

        return $this;
    }