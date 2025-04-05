public function setEndTime($value)
    {
        if ($value instanceof \DateTime) {
            $value->setTimezone(new \DateTimeZone('UTC'));
            $value = $value->format('Y-m-d\TH:i:s\Z');
        }
        return $this->setParameter('endTime', $value);
    }