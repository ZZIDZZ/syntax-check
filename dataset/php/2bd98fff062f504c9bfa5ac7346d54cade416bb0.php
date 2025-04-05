public function defaultFilters($filters = [])
    {
        if (empty($filters)) {
            return false;
        }
        foreach ($filters as $key => $value) {
            $filterName = 'Filter-' . str_replace('.', '-', $key);
            $explodedFilterName = explode('-', $filterName);
            if (count($explodedFilterName) !== 3) {
                return false;
            }
            if (empty($this->_controller->request->query[$filterName])) {
                // set request POST data so the inputs will be filled
                $this->_controller->request->data[$explodedFilterName[0]][$explodedFilterName[1]][$explodedFilterName[2]] = $value;
                $this->_controller->paginate['conditions'][$key] = $value;
            } elseif ($this->_controller->request->query[$filterName] == 'all') {
                unset($this->_controller->request->data[$explodedFilterName[0]][$explodedFilterName[1]][$explodedFilterName[2]]);
                unset($this->_controller->paginate['conditions'][$key]);
            }
        }

        return true;
    }