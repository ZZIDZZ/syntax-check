public function split(array $percentages, bool $round = true): array
    {
        $totalPercentage = array_sum($percentages);
        if ($totalPercentage > 100) {
            throw new InvalidArgumentException('Only 100% can be allocated');
        }
        $amounts = [];
        $total = 0;
        if (!$round) {
            foreach ($percentages as $percentage) {
                $share = $this->percentage($percentage);
                $total += $share->getAmount();
                $amounts[] = $share;
            }
            if ($totalPercentage != 100) {
                $amounts[] = new static($this->amount - $total, $this->currency);
            }
            return $amounts;
        }

        $count = 0;

        if ($totalPercentage != 100) {
            $percentages[] = 0; //Dummy record to trigger the rest of the amount being assigned to a final pot
        }

        foreach ($percentages as $percentage) {
            ++$count;
            if ($count == count($percentages)) {
                $amounts[] = new static($this->amount - $total, $this->currency);
            } else {
                $share = $this->percentage($percentage)->round();
                $total += $share->getAmount();
                $amounts[] = $share;
            }
        }

        return $amounts;
    }