public function summaryMatchKey($section, $matchKey, $sectionKey)
    {
        if (!is_string($section)) {
            $section = null;
        }

        if (!is_string($matchKey)) {
            $matchKey = null;
        }

        if (!is_numeric($sectionKey)) {
            $sectionKey = 0;
        }

        $output = '';

        if (isset($this->log_sections[$section]) && is_array($this->log_sections[$section]) && $matchKey !== null) {
            $matchKeyTime = [];
            $matchKeyMemory = [];

            foreach ($this->log_sections[$section] as $key => $item) {
                if (isset($item['matchKey']) && $item['matchKey'] == $matchKey && $key <= $sectionKey) {
                    if (count($matchKeyMemory) >= 2 || count($matchKeyTime) >= 2) {
                        break;
                    }

                    if (isset($item['time'])) {
                        $matchKeyTime[] = $item['time'];
                    }

                    if (isset($item['memory'])) {
                        $matchKeyMemory[] = $item['memory'];
                    }
                }
            }// endforeach;
            unset($item, $key);

            if (count($matchKeyTime) >= 2) {
                $output = $this->getReadableTime((max($matchKeyTime)-min($matchKeyTime))*1000);
            } elseif (count($matchKeyMemory) >= 2) {
                $output = $this->getReadableFileSize(max($matchKeyMemory)-min($matchKeyMemory));
            }

            unset($matchKeyMemory, $matchKeyTime);
        }

        return $output;
    }