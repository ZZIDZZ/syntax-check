public function search(array $rows, $query, $threshold = 3)
    {
        $matched = [];

        foreach($rows as $row)
        {
            $distance = $this->calculateDistance($query, $row);

            if ($threshold >= $distance)
            {
                $matched[] = [$distance, $row];
            }
        }

        return $this->transformResult($this->sortMatchedStrings($matched));
    }