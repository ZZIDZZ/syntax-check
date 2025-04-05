protected static function removeValue(&$item, $index, &$err = null)
    {
        $err = null;

        if (!is_object($item) && !is_array($item)) {
            $err = (object)['var' => gettype($item), 'incomplete' => count($index)];
            return;
        }
        
        $key = array_shift($index);
        
        if (empty($index)) {
            if (is_object($item) && isset($item->$key)) unset($item->$key);
            if (is_array($item) && isset($item[$key])) unset($item[$key]);
            return;
        }
        
        if (is_object($item) && isset($item->$key)) return static::removeValue($item->$key, $index, $err);
        if (is_array($item) && isset($item[$key])) return static::removeValue($item[$key], $index, $err);
    }