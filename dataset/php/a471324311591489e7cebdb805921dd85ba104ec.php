static public function validateSize($size, $throwException = true)
    {
        if (in_array($size, [
            self::SIZE_NORMAL,
            self::SIZE_SMALL,
            self::SIZE_WIDE,
            self::SIZE_LARGE,
        ])) {
            return true;
        }

        if ($throwException) {
            throw new \InvalidArgumentException(sprintf('Invalid modal size "%s".', $size));
        }

        return false;
    }