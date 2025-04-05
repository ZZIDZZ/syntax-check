public function getLangCodes($withAuto = true)
    {
        if (! is_bool($withAuto)) {
            throw new \InvalidArgumentException('The $withAuto argument has to be boolean');
        }

        if ($withAuto) {
            return self::LANG_CODES;
        }

        // ATTENTION! This only works as long as self::LANG_AUTO is the first item!
        return array_slice(self::LANG_CODES, 1);
    }