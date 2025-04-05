public function haveTheFileImplementationOf($file, $implementation = 'PluginInterface') {
        $matches = array();
        $fp = fopen($file, 'r');
        while (!feof($fp)) {
            $line = stream_get_line($fp, 1000000, "\n");
            if (preg_match('/class\s+(\w+)(.*)\simplements\s+(\w+)(.*)?\{/', $line, $matches)) {
                if ($matches[3] === $implementation) {
                    return $matches[1]; //Return the class name
                }
            }
        }
        return false;
    }