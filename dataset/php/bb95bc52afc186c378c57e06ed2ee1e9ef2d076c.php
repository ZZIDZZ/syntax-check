public function parse($text)
    {
        $text = str_replace(array("\r\n", "\r"), "\n", $text);

        foreach ($this->quoteHeadersRegex as $regex) {
            if (preg_match($regex, $text, $matches)) {
                $text = str_replace($matches[1], str_replace("\n", ' ', $matches[1]), $text);
            }
        }

        $fragment = null;
        $text_array = explode("\n", $text);
        while (($line = array_pop($text_array)) !== NULL) {
            $line = ltrim($line, "\n");

            if (!$this->isSignature($line)) {
                $line = rtrim($line);
            }

            if ($fragment) {
                $first = reset($fragment->lines);

                if ($this->isSignature($first)) {
                    $fragment->isSignature = true;
                    $this->addFragment($fragment);

                    $fragment = null;
                } elseif (empty($line) && $this->isQuoteHeader($first)) {
                    $fragment->isQuoted = true;
                    $this->addFragment($fragment);

                    $fragment = null;
                }
            }

            $isQuoted = $this->isQuote($line);

            if (null === $fragment || !$this->isFragmentLine($fragment, $line, $isQuoted)) {
                if ($fragment) {
                    $this->addFragment($fragment);
                }

                $fragment = new FragmentDTO();
                $fragment->isQuoted = $isQuoted;
            }

            array_unshift($fragment->lines, $line);
        }

        if ($fragment) {
            $this->addFragment($fragment);
        }

        $email = $this->createEmail($this->fragments);

        $this->fragments = array();

        return $email;
    }