public function convert($string, $delimiter = '_')
    {
        $func = create_function('$c', 'return strtoupper($c[1]);');

        return preg_replace_callback('/[\s]+(.)/', $func, str_replace($delimiter, ' ', $string));
    }