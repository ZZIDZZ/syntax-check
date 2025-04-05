private function _prepareURI($uri)
    {
        global $base_url;

        if (str_begins_with($uri, '/') || ! str_begins_with($uri, 'http')) {
            return trim($base_url.'/'.trim($uri, '/'), '/');
        }

        return trim($uri, '/');
    }