public function remove(Request $request)
    {
        $instance   = $this->resolveModel();
        $connection = $instance->getConnection();
        $affected   = [];
        $errors     = [];

        $connection->beginTransaction();
        foreach ($request->get('data') as $key => $data) {
            $model     = $instance->newQuery()->find($key);
            $validator = $this->getValidationFactory()
                              ->make($data, $this->removeRules($model), $this->removeMessages(), $this->attributes());
            if ($validator->fails()) {
                foreach ($this->formatErrors($validator) as $error) {
                    $errors[] = $error['status'];
                }

                continue;
            }

            try {
                if (method_exists($this, 'deleting')) {
                    $this->deleting($model, $data);
                }

                $model->delete();

                if (method_exists($this, 'deleted')) {
                    $this->deleted($model, $data);
                }
            } catch (QueryException $exception) {
                $error    = config('app.debug') ? $exception->errorInfo[2] : $this->removeExceptionMessage($exception, $model);
                $errors[] = $error;
            }

            $affected[] = $model;
        }

        if (! $errors) {
            $connection->commit();
        } else {
            $connection->rollBack();
        }

        $response = ['data' => $affected];
        if ($errors) {
            $response['error'] = implode("\n", $errors);
        }

        return new JsonResponse($response, 200);
    }