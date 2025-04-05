public function processRecord($record, $columnMap, &$results, $preview = false)
    {
        $page = $this->findExistingObject($record, $columnMap);

        if (!$page || !$page->exists()) {
            return false;
        }

        foreach ($record as $fieldName => $val) {
            if ($fieldName == 'MetaTitle' || $fieldName == 'MetaDescription') {
                $sqlValue = Convert::raw2sql($val);
                DB::query("UPDATE SiteTree SET {$fieldName} = '{$sqlValue}' WHERE ID = {$page->ID}");
                if ($page->isPublished()) {
                    DB::query("UPDATE SiteTree_Live SET {$fieldName} = '{$sqlValue}' WHERE ID = {$page->ID}");
                }
            }
        }

        return $page->ID;
    }