public static function build($pdo, $sql, array $params)
    {
        $bind_values = [];
        $sql = strtr($sql, "\n", ' ');
        $sql = preg_replace_callback(
            '/'.Query::RE_HOLDER.'/',
            function ($m) use ($pdo, $params, &$bind_values) {
                $key  = $m['key'];
                $type = $m['type'];

                if (!isset($params[$key])) {
                    throw new \OutOfRangeException(sprintf('param "%s" expected but not assigned', $key));
                }

                return self::replaceHolder($pdo, $key, $type, $params[$key], $bind_values);
            },
            $sql
        );

        $stmt = $pdo->prepare($sql);

        foreach ($bind_values as $key => list($type, $value)) {
            $stmt->bindParam($key, $value, $type);
        }

        return $stmt;
    }