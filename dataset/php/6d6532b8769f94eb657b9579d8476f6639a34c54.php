public function firstHumpArray(...$parameters){
        $res = $this->firstHump(...$parameters);
        if ($res instanceof EloquentModel){
            $res = $res->toArray();
        }
        return $res;
    }