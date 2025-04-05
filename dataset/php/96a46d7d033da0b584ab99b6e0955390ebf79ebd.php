protected function removeXmlFirstLine($str)
    {
        $first = '<?xml version="1.0"?>';
        if (Str::startsWith($str, $first)) {
            return trim(substr($str, strlen($first)));
        }

        return $str;
    }