private static function extractAuthUserPass($encodedString)
    {
        if (0 >= strlen($encodedString)) {
            return false;
        }
        $decodedString = base64_decode($encodedString, true);
        if (false === $decodedString) {
            return false;
        }

        $firstColonPos = strpos($decodedString, ':');
        if (false === $firstColonPos) {
            return false;
        }

        return array(
            'authUser' => substr($decodedString, 0, $firstColonPos),
            'authPass' => substr($decodedString, $firstColonPos + 1),
        );
    }