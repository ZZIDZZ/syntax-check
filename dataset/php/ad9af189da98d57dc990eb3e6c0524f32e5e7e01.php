public function index($columns, $type, $suffix = '') {
        $type = strtolower($type);
        $columns = (array)$columns;
        $suffix = strtolower($suffix);

        // Look for a current index row.
        $currentIndex = null;
        foreach ($this->indexes as $i => $index) {
            if ($type !== $index['type']) {
                continue;
            }

            $indexSuffix = val('suffix', $index, '');

            if ($type === Db::INDEX_PK ||
                ($type === Db::INDEX_UNIQUE && $suffix == $indexSuffix) ||
                ($type === Db::INDEX_IX && $suffix && $suffix == $indexSuffix) ||
                ($type === Db::INDEX_IX && !$suffix && array_diff($index['columns'], $columns) == [])
            ) {
                $currentIndex =& $this->indexes[$i];
                break;
            }
        }

        if ($currentIndex) {
            $currentIndex['columns'] = array_unique(array_merge($currentIndex['columns'], $columns));
        } else {
            $indexDef = [
                'type' => $type,
                'columns' => $columns,
                'suffix' => $suffix
            ];
            if ($type === Db::INDEX_PK) {
                $this->indexes[Db::INDEX_PK] = $indexDef;
            } else {
                $this->indexes[] = $indexDef;
            }
        }

        return $this;
    }