protected static function getValue($sCode) {

        switch($sCode) {
            case self::FIRST_BUTTON_CODE:
                return 1;
            case self::FIRST_MORE_BUTTON_CODE:
                return null;
            case self::PREV_BUTTON_CODE:
                $iValue = self::$iCurrentPage - 1;
                if($iValue  < 1) {
                    $iValue = 1;
                }

                return $iValue;
            case self::PREV_MORE_BUTTON_CODE:
                return null;
            case self::NEXT_MORE_BUTTON_CODE:
                return null;
            case self::NEXT_BUTTON_CODE:
                $iValue = self::$iCurrentPage + 1;
                if($iValue > self::$iTotalCountPages) {
                    $iValue = self::$iTotalCountPages;
                }

                return $iValue;
            case self::LAST_MORE_BUTTON_CODE:
                return null;
            case self::LAST_BUTTON_CODE:
                return self::$iTotalCountPages;
        }

        return null;
    }