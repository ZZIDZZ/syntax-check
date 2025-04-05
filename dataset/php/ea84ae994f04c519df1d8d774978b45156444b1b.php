public function save(ScheduleInterface $schedule, $andFlush = true)
    {
        $this->objectManager->persist($schedule);
        if ($andFlush)
        {
            $this->objectManager->flush();
        }
    }