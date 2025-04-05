public static function searchByQuery($query = null, $aggregations = null, $sourceFields = null, $limit = null, $offset = null, $sort = null)
    {
        $instance = new static;

        $params = $instance->getBasicEsParams(true, true, true, $limit, $offset);

        if ($sourceFields) {
            $params['body']['_source']['include'] = $sourceFields;
        }

        if ($query) {
            $params['body']['query'] = $query;
        }

        if ($aggregations) {
            $params['body']['aggs'] = $aggregations;
        }
        
        if ($sort) {
            $params['body']['sort'] = $sort;
        }

        $result = $instance->getElasticSearchClient()->search($params);

        return new ResultCollection($result, $instance = new static);
    }