public static function buildTask($command, $groupName)
    {
        $groupConfig = [
            'email_notification' => 0,
            'allow_parallel_run' => 0,
            'group_notifications' => 0,
            'run_last_command_only' => 0,
        ];
        if (null === $group = DeferredGroup::findOne(['name' => $groupName])) {
            $group = new DeferredGroup();
            $group->loadDefaultValues();
            $group->setAttributes($groupConfig);
            $group->name = $groupName;
            $group->save();
        }
        if ((int)$group->group_notifications !== 0) {
            // otherwise DeferredController 'deferred-queue-complete' event will not trigger
            // and we'll unable to write config
            $group->setAttributes($groupConfig);
            $group->save(array_keys($groupConfig));
        }
        $task = new ReportingTask();
        $task->model()->deferred_group_id = $group->id;
        $task->cliCommand(DeferredHelper::getPhpBinary(), $command);
        return $task;
    }