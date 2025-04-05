public static function baseURI()
    {
        // Check if uri contains a query.
        $uri = $_SERVER['REQUEST_URI'];
        $qmIsHere  = strpos($uri, '?');
        $uri  = ($qmIsHere === false) ? $uri :
            substr($uri, 0, $qmIsHere);
        // Get file name
        return pathinfo($uri)['filename'];
    }