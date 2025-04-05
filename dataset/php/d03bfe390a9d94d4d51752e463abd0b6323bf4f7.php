protected function checkProcess(ProcessConfiguration $processConfiguration): void
    {
        $processConfiguration->checkCircularDependencies();

        $taskConfigurations = $processConfiguration->getTaskConfigurations();
        $mainTaskList = $processConfiguration->getMainTaskGroup();
        $entryPoint = $processConfiguration->getEntryPoint();
        $endPoint = $processConfiguration->getEndPoint();

        // Check multi-branch processes
        foreach ($taskConfigurations as $taskConfiguration) {
            if (!\in_array($taskConfiguration->getCode(), $mainTaskList, true)) {
                // We won't throw an error to ease development... but there must be some kind of warning
                $state = $taskConfiguration->getState();
                $logContext = ['main_task_list' => $mainTaskList];
                $this->processLogger->warning("Task '{$taskConfiguration->getCode()}' is unreachable", $logContext);
                $this->handleState($state);
            }
        }

        // Check coherence for entry/end points
        $processConfiguration->getEndPoint();
        if ($entryPoint && !\in_array($entryPoint->getCode(), $mainTaskList, true)) {
            throw InvalidProcessConfigurationException::createNotInMain($entryPoint, $mainTaskList);
        }
        if ($endPoint && !\in_array($endPoint->getCode(), $mainTaskList, true)) {
            throw InvalidProcessConfigurationException::createNotInMain($endPoint, $mainTaskList);
        }
    }