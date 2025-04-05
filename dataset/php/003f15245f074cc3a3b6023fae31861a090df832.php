public function getValues($section = 0)
    {
        if (!isset($this->content[$section])) {
            return array();
        }
        $values = array();
        foreach ($this->content[$section] as $k => $item) {
            if ($item[0] != self::TK_VALUE && $item[0] != self::TK_ARR_VALUE) {
                continue;
            }

            $val = $this->convertValue($item[2]);

            if ($item[0] == self::TK_VALUE) {
                $values[$item[1]] = $val;
            } else {
                $values[$item[1]][$item[3]] = $val;
            }
        }

        return $values;
    }