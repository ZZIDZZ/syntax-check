public static function random($charsAmount, $chars = array())
    {
        if (!$chars) {
            $chars = array(
                'a', 'b', 'c', 'd', 'e',
                'f', 'g', 'h', 'i', 'j',
                'k', 'l', 'm', 'n', 'o',
                'p', 'q', 'r', 's', 't',
                'u', 'v', 'w', 'x', 'y',
                'z', '0', '1', '2', '3',
                '4', '5', '6', '7', '8',
                '9', '_'
            );
        }

        $str = '';

        for ($i=1; $i<=$charsAmount; $i++) {
            $str .= $chars[array_rand($chars)];
        }

        return $str;
    }