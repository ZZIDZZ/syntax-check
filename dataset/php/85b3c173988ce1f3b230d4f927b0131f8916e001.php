private final function getColumnSyntaxe(ColumnInterface $column)
    {
        $mySql = "`" . $column->getName() . "` "
               . $this->constant($column->getType())
               . "(" . $column->getSize() . ")";
        foreach ($column->getOption() as $option) {
            $const = $this->constant($option);
            $mySql .= $const ? " " . $const : "";
        }
        return $mySql . ",\n";
    }