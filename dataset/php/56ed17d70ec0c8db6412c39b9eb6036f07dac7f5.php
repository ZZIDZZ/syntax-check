public function populateNumericColumnsWithLongestValue()
    {
        $query = DB::table($this->name);
        foreach ($this->columns as $column) {
            if ($column->isNumeric()) {
                $query->addSelect(DB::raw('MIN(`' . $column->name . '`) as `' . $column->name . '`'));
            }
        }
        $result = $query->first();
        foreach ($this->columns as $column) {
            $columnName = $column->name;
            if (isset($result->$columnName)) {
                $column->setMinValue($result->$columnName);
            }
        }
    }