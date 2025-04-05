public function actionUpdate($id = null)
    {
        if ($id === null) {
            $model = new Page();
            $model->display_title = true;
        } else {
            $model = $this->findModel($id);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Module::t('SAVE_SUCCESS'));
            return $this->redirect(['update', 'id' => $model->id]);
        }
        
        $module = Yii::$app->getModule('pages');
        
        return $this->render($id === null ? 'create' : 'update', [
            'model' => $model,
            'module' => $module,
        ]);
    }