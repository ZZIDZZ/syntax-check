protected function clearRow()
    {

        // query whether or not the column keys has been initialized
        if ($this->cleanUpEmptyColumnKeys === null) {
            // initialize the array with the column keys that has to be cleaned-up
            $this->cleanUpEmptyColumnKeys = array();

            // query whether or not column names that has to be cleaned up have been configured
            if ($this->getSubject()->getConfiguration()->hasParam(ConfigurationKeys::CLEAN_UP_EMPTY_COLUMNS)) {
                // if yes, load the column names
                $cleanUpEmptyColumns = $this->getSubject()->getCleanUpColumns();

                // translate the column names into column keys
                foreach ($cleanUpEmptyColumns as $cleanUpEmptyColumn) {
                    if ($this->hasHeader($cleanUpEmptyColumn)) {
                        $this->cleanUpEmptyColumnKeys[] = $this->getHeader($cleanUpEmptyColumn);
                    }
                }
            }
        }

        // remove all the empty values from the row, expected the columns has to be cleaned-up
        return array_filter(
            $this->row,
            function ($value, $key) {
                return ($value !== null && $value !== '') || in_array($key, $this->cleanUpEmptyColumnKeys);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }