private static function setByCaseInsensitiveKey(array $words, $key, $newValue) {
        foreach ($words as $headerWord => $value) {
            if (strcasecmp($headerWord, $key) === 0) {
                $key = $headerWord;

                break;
            }
        }

        $words[$key] = $newValue;

        return $words;
    }