protected function getQueue($request)
    {
        $queue = $request->getVar('queue');

        if (!$queue) {
            $queue = 'Queued';
        }

        switch (strtolower($queue)) {
            case 'immediate':
                $queue = QueuedJob::IMMEDIATE;
                break;
            case 'queued':
                $queue = QueuedJob::QUEUED;
                break;
            case 'large':
                $queue = QueuedJob::LARGE;
                break;
            default:
                break;
        }

        return $queue;
    }