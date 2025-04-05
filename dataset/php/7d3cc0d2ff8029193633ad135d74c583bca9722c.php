public function scopeSearchByFeature($query, $name = null, $feature_class=null, $featureCodes = null)
    {
        $table = 'geonames_geonames';

        if (!isset($query->getQuery()->columns))
            $query = $query->addSelect($this->usefulScopeColumns);

        if ($name !== null)
            $query = $query->where($table . '.name', 'LIKE', $name);

        $query = $query
            ->where($table . '.feature_class', $feature_class)
            ->whereIn($table . '.feature_code', $featureCodes);

        return $query;
    }