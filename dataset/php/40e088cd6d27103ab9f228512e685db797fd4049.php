protected function createJob(CronJob $dbJob)
    {
        $job = new ShellJob();
        $job->setCommand($this->commandBuilder->build($dbJob->getCommand()), $this->rootDir);
        $job->setSchedule(new CrontabSchedule($dbJob->getSchedule()));
        $job->raw = $dbJob;

        return $job;
    }