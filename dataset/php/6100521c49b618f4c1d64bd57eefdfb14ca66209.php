public static function readLength(array $data)
    {
        $length = $data[0];
        switch ($length) {
            case 251:
                return MySQLMessage::$NULL_LENGTH;
            case 252:
                return self::readUB2($data);
            case 253:
                return self::readUB3($data);
            case 254:
                return self::readLong($data);
            default:
                return $length;
        }
    }