public function hasMonth($month)
    {
        $bitmask = $this->getMonthBitmask();
        $month   = (int) $month;

        $bit = pow(2, $month - 1);

        return ($bit === ($bit & $bitmask));
    }