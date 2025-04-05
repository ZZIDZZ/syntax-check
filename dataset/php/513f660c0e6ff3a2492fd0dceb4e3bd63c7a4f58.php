public function flushChanges()
    {
        $queue = QueuedJobService::singleton();
        if (!empty($this->toUpdate)) {
            foreach ($this->toUpdate as $queueItem) {
                $job = Injector::inst()->create(GenerateStaticCacheJob::class);

                $jobData = new \stdClass();
                $urls = $queueItem->urlsToCache();
                ksort($urls);
                $jobData->URLsToProcess = $urls;

                $job->setJobData(0, 0, false, $jobData, [
                    'Building URLs: ' . var_export(array_keys($jobData->URLsToProcess), true)
                ]);

                $queue->queueJob($job);
            }
            $this->toUpdate = array();
        }

        if (!empty($this->toDelete)) {
            foreach ($this->toDelete as $queueItem) {
                $job = Injector::inst()->create(DeleteStaticCacheJob::class);

                $jobData = new \stdClass();
                $urls = $queueItem->urlsToCache();
                ksort($urls);
                $jobData->URLsToProcess = $urls;

                $job->setJobData(0, 0, false, $jobData, [
                    'Purging URLs: ' . var_export(array_keys($jobData->URLsToProcess), true)
                ]);

                $queue->queueJob($job);
            }
            $this->toDelete = array();
        }
    }