public function validateDocUrl($url)
    {
        $pattern = '/http:\/\/docs\.google\.com\/spreadsheets\/d\/.*\/export\?format=csv/';

        if (is_null($url) || $url === '' || preg_match($pattern, $url) !== 1) {
            return false;
        }

        return true;
    }