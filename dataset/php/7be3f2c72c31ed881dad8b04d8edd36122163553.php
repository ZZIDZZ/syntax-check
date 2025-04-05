public function prevNext($currentRecordId)
    {
        $recordIds = (array) $this->getSession('ids');
        $prevRecordId = $nextRecordId = null;

        $currentKey = array_search($currentRecordId, $recordIds);
        if (false !== $currentKey) {
            if ($currentKey > 0) {
                $prevRecordId = $recordIds[$currentKey - 1];
            }
            if ($currentKey < count($recordIds) - 1) {
                $nextRecordId = $recordIds[$currentKey + 1];
            }
        }

        return [$prevRecordId, $nextRecordId];
    }