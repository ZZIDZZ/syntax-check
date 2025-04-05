public function actionUpdateExpired()
    {
        $packages = $this->packageRepository->getExpiredForUpdate();

        foreach ($packages as $package) {
            $package->load();
            Yii::$app->queue->push(Yii::createObject(PackageUpdateCommand::class, [$package]));

            $message = 'Package %N' . $package->getFullName() . '%n';
            $message .= ' was updated ' . Yii::$app->formatter->asRelativeTime($package->getUpdateTime());
            $message .= ". %GAdded to queue for update%n\n";
            $this->stdout(Console::renderColoredString($message));
        }
    }