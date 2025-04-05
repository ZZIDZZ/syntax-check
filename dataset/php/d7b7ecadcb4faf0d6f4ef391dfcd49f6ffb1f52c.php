protected function detectByKey($keyName = 'family'): array
    {
        foreach ($this->config as $key => $data) {
            if ($key === 'default') {
                continue;
            }
            $detectedData = $this->detectByType($key);
            if (!empty($detectedData)) {
                return array_merge($detectedData, [$keyName => $key]);
            }
        }
        return [];
    }