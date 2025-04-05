private function insertJobRecord($payload, $time, $queue)
    {
        if (!$time instanceof DateTime) {
            throw new ErrorException('An explicit DateTime value $time is required. ');
        }
        $jobId = DB::table($this->table)->insertGetId([
            'queue_name' => $queue, 
            'payload'  => $payload, 
            'status'   => 'pending', 
            'attempts' => 1, 
            'fireon'   => $time->getTimestamp(), 
        ]);
        return $jobId; 
    }