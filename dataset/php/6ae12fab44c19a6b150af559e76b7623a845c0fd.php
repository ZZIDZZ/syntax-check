public static function socket_fetch($socket)
    {
        // read 4 byte length first
        $hdr = '';
        do {
            $read = socket_read($socket, 4 - strlen($hdr));
            if ($read === false or $read === '') {
                return null;
            }
            $hdr .= $read;
        } while (strlen($hdr) < 4);

        list($len) = array_values(unpack("N", $hdr));

        // read the full buffer
        $buffer = '';
        do {
            $read = socket_read($socket, $len - strlen($buffer));
            if ($read === false or $read == '') {
                return null;
            }
            $buffer .= $read;
        } while (strlen($buffer) < $len);

        $data = unserialize($buffer);
        return $data;
    }