protected function counterToString($counter)
    {
        $tmp = "";
        while ($counter != 0) {
            $tmp .= chr($counter & 0xff);
            $counter >>= 8;
        }

        return substr(str_pad(strrev($tmp), 8, "\0", STR_PAD_LEFT), 0, 8);
    }