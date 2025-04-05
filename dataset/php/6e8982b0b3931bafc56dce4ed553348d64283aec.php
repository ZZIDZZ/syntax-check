static protected function getWindowsTerminalSize() {
        $output = self::exec('mode', $returnCode);
        if ($returnCode !== 0)
            return [25, 80];

        foreach ($output as $i => $line) {
            if (strpos($line, ' CON') !== false) {
                $sizes = [$output[$i + 2], $output[$i + 3]];
                break;
            }
        }
        if (!isset($sizes))
            return [25, 80];

        return array_map(function($val) { list(, $val) = explode(':', $val); return trim($val); }, $sizes);
    }