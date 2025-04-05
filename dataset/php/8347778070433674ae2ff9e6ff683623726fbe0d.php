private function handleModelNotFound(ModelNotFoundException $e)
    {
        $e = new NotFoundHttpException($e->getMessage(), $e, $e->getCode());
        return $this->handle($e);
    }