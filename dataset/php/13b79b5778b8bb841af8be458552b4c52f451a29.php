public function executeSql($sql, $params = [], $lazy = true) {
        list($sql, $params) = $this->convertSqlToIndexed($sql, $params);
        $promiseResolver = function($r, $c) use ($sql, $params) {
            $result = [];
            $this->getPgClient()->executeStatement($sql, $params)->subscribe(
                function($row) use (&$result) {
                    $result[] = $row;
                },
                function($error = null) use (&$c) {
                    $c($error);
                },
                function() use (&$r, &$result) {
                    $r($result);
                }
            );
        };
        if (!$lazy) {
            return new Promise($promiseResolver);
        }
        $promiseCreator = function() use (&$promiseResolver) {
            return new Promise($promiseResolver);
        };
        return new LazyPromise($promiseCreator);
    }