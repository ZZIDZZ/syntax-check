public static function parseQueryStringFromUrl($url)
    {
        $query = (string) parse_url($url, \PHP_URL_QUERY);
        parse_str($query, $result);
        return $result;
    }