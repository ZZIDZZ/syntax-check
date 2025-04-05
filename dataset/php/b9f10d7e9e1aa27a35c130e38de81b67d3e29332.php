public function findModel($id = false, $search = false)
    {
        $model = Module::getModel(
            $this,
            ($search ? $this->searchModelName : $this->modelName),
            ['controllers' => 'models'],
            ['scenario' => $this->getScenario()]
        );
        if ($id && (!$model = $model->search(compact('id'))->one())) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $model->scenario = $this->getScenario(); // for found model too
        return $model;
    }