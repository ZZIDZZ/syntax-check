public function mergeOverlappedTimeSlots(TimeSlotGeneratorInterface $timeSlotGenerator, array $timeSlots)
    {
        if (empty($timeSlots)) {
            return [];
        }

        $timeSlots = $this->sortTimeSlotsByStartTime($timeSlots);
        $mergedTimeSlots = [
            $timeSlotGenerator->createTimeSlot($timeSlots[0]->getStart(), $timeSlots[0]->getEnd()),
        ];
        $headIndex = 0;

        foreach ($timeSlots as $timeSlot) {
            $headTimeSlot = $mergedTimeSlots[$headIndex];

            if ($timeSlot->getStart() > $headTimeSlot->getEnd()) {
                $mergedTimeSlots[] = $timeSlotGenerator->createTimeSlot(
                    $timeSlot->getStart(),
                    $timeSlot->getEnd()
                );
                $headIndex ++;
            } elseif ($headTimeSlot->getEnd() < $timeSlot->getEnd()) {
                $mergedTimeSlots[$headIndex] = $timeSlotGenerator->createTimeSlot(
                    $headTimeSlot->getStart(),
                    $timeSlot->getEnd()
                );
            }
        }

        return $mergedTimeSlots;
    }