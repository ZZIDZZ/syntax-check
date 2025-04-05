protected static function base32_decode($b32)
    {
        $b32 = strtoupper($b32);

        if (!preg_match('/^[ABCDEFGHIJKLMNOPQRSTUVWXYZ234567]+$/', $b32, $match)) {
            throw new Exception('Invalid characters in the base32 string.');
        }

        $l = strlen($b32);
        $n = 0;
        $j = 0;
        $binary = '';

        for ($i = 0; $i < $l; ++$i) {
            $n = $n << 5;                    // Move buffer left by 5 to make room
            $n = $n + self::$lut[$b32[$i]]; // Add value into buffer
            $j = $j + 5;                    // Keep track of number of bits in buffer

            if ($j >= 8) {
                $j = $j - 8;
                $binary .= chr(($n & (0xFF << $j)) >> $j);
            }
        }

        return $binary;
    }