public function actionIndex()
    {
        $items = Item::updateAll(Yii::$app->request->post('Item'));
        if ($items === true) {
            Yii::$app->session->setFlash('info', Yii::t('modules/module', 'Updated'));
            return $this->refresh();
        } else if (!$items) {
            $items = Item::findAll();
        }
        return $this->render('index', [
            'dataProvider' =>  new ArrayDataProvider([
                'allModels' => $items, 'key' => 'id'
            ]),
        ]);
    }