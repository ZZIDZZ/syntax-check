final public static function replaceAllDotsExceptLast(string $string): string
    {
        $countDots = substr_count($string, '.');
        if ($countDots > 1) {
            $stringArray = explode('.', $string);
            $string = '';
            for ($i = 0; $i < $countDots - 1; ++$i) {
                $string .= $stringArray[$i].'_';
            }
            $string .= $stringArray[$countDots - 1].'.'.$stringArray[$countDots];
        }

        return $string;
    }