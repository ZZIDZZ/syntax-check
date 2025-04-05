public static function breakpoint($message, $line = false, $file = false, $status = null)
    {
        if (!is_scalar($message)) {
            $message = print_r($message, 1);
        }
        $message = self::appendFL($message, $line, $file);
        if (php_sapi_name() === 'cli') {
            $message .= PHP_EOL;
        } else {
            $message = '<pre>'.htmlspecialchars($message, ENT_COMPAT, 'UTF-8').'</pre>';
        }
        self::out($message);
        self::stop($status);
    }