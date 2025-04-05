public function mostTimeConsumingDomain()
    {
        $total = array();

        // Gather total duration data of each domain
        foreach ($this->timestamp as $val) {
            $duration = round($val['duration'], $this->precision);
            @$total[$val['domain']] += $duration;
        }

        // Get the key of the most time consuming element
        $mostConsumingTime = 0;
        $mostConsumingDomain = "";
        foreach ($total as $key => $val) {
            if ($val >= $mostConsumingTime) {
                $mostConsumingDomain = $key;
                $mostConsumingTime = $val;
            }
        }

        return $mostConsumingDomain;
    }