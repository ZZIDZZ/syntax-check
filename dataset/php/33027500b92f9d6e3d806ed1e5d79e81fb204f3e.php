public function actionDump()
    {
        try {
            $result = \Yii::$app->dbDumper->dump();
            $this->stdout(\Yii::t('skeeks/dbDumper', "Dump the database was created successfully").": {$result}\n",
                Console::FG_GREEN);
            $removed = \Yii::$app->dbDumper->clear();
            if ($removed > 0) {
                $this->stdout(\Yii::t('skeeks/dbDumper', "Removed old dumps").": {$removed}\n", Console::FG_GREEN);
            }

        } catch (\Exception $e) {
            $this->stdout(\Yii::t('skeeks/dbDumper', "During the dump error occurred").": {$e->getMessage()}\n",
                Console::FG_RED);
        }
    }