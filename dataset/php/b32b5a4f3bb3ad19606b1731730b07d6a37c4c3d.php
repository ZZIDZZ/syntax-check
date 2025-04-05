public static function cleanString($string)
    {
        $string = str_replace(array('&nbsp;', '<br/>', '<br>'), ' ', $string);
        $string = strip_tags($string);
        $string = str_replace(' ', ' ', $string);
        
        return $string;
    }