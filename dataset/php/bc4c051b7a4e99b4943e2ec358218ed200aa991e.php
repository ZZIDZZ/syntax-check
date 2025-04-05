private function syntaxError($expected)
    {
        $expected = sprintf('Expected %s, got', $expected);
        $token    = $this->lexer->lookahead;
        $found    = null === $this->lexer->lookahead ? 'end of string.' : sprintf('"%s"', $token['value']);
        $message  = sprintf(
            '[Syntax Error] line 0, col %d: Error: %s %s in value "%s"',
            isset($token['position']) ? $token['position'] : '-1',
            $expected,
            $found,
            $this->input
        );

        return new UnexpectedValueException($message);
    }