private static function validateDuplicatedKey($input)
    {
        $lines = explode("\n", $input);
        $data = array();
        $nbSpacesOfLastLine = 0;
        
        foreach ($lines as $linenumber => $line) {
            $trimmedLine = ltrim($line, ' ');
            if ($trimmedLine === '' || $trimmedLine[0] === '#') {
                continue;
            }

            $nbSpacesOfCurrentLine = strlen($line) - strlen($trimmedLine);

            if ($nbSpacesOfCurrentLine < $nbSpacesOfLastLine) {
                foreach ($data as $nbSpaces => $keys) {
                    if ($nbSpaces > $nbSpacesOfCurrentLine) {
                        unset($data[$nbSpaces]);
                    }
                }
            }

            if ($trimmedLine[0] === '-' || false === $pos = strpos($trimmedLine, ':')) {
                continue;
            }

            $key = substr($trimmedLine, 0, $pos);

            if (isset($data[$nbSpacesOfCurrentLine][$key])) {
                throw new ParseException(sprintf('Duplicate key "%s" detected on line %s whilst parsing YAML.', $key, $linenumber));
            }

            $data[$nbSpacesOfCurrentLine][$key] = array();
            $nbSpacesOfLastLine = $nbSpacesOfCurrentLine;
        }
    }