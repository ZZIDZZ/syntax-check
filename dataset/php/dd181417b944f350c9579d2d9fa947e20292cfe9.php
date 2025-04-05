protected function findModel($message_id, $language)
    {
        if (($model = I18nTranslation::findOne(['message_id' => $message_id, 'language' => $language])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }