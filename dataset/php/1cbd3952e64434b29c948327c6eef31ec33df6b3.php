public function hours($downTo=15, $decimalPlaces=2)
    {
        if (! $this->has(['start','end']))
            return 0;

        $diff = $this->start->diffInMinutes($this->end);
        $minutes = $diff - ($downTo / 2);

        $hours = $minutes / 60;
        $periodsPerHour = 60 / $downTo;
        $roundedHours = round(
            round($hours * $periodsPerHour) / $periodsPerHour, 
            $decimalPlaces
        );

        $whole = floor($roundedHours);
        $fraction = round($roundedHours - $whole,2);
        $periodLength = round(1.0 / $periodsPerHour,2);

        if ($fraction == $periodLength && $diff % $downTo === 0)
            return ($roundedHours - $periodLength);

        return $roundedHours;
    }