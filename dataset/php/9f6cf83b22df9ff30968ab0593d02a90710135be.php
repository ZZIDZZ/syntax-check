public function actionIndex()
    {
        $config = new Configuration;
        $config->getPresenter()->addCasters(
            $this->getCasters()
        );
        $shell = new Shell($config);
        $shell->setIncludes($this->include);
        $shell->run();
    }