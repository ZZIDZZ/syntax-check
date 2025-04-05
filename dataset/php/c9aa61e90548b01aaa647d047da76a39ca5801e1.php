public static function render()
    {
        if (!empty(self::$_models)) {
            foreach (self::$_models as $model) {
                try {
                    echo Html::script(Json::encode($model->toJsonLDArray()), ['type' => 'application/ld+json']) . "\n";
                } catch (InvalidArgumentException $e) {
                    $logger = Yii::$app->log->logger;
                    $logger->log($e->getMessage(), $logger::LEVEL_ERROR);
                }
            }
        }
    }