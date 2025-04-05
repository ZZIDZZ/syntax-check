public function haveRecord($model, $attributes = array())
    {
        $id = $this->app['db']->table($model)->insertGetId($attributes);
        if (!$id) {
            $this->fail("Couldn't insert record into table $model");
        }
        return $id;
    }