private function headerParse($rawHeader)
    {

        $headers = array();

        $headerLine = substr($rawHeader, 0, strpos($rawHeader, "\r\n\r\n"));

        foreach (explode("\r\n", $headerLine) as $i => $line) {
            if ($i === 0) {
                $headers['Status-Line'] = $line;
                continue;
            }

            list ($key, $value) = explode(': ', $line);
            $headers[$key] = $value;
        }

        return $headers;
    }