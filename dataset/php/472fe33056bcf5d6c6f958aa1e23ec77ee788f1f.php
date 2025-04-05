public function getValue()
    {
        $directives = [];
        foreach ($this->directives as $name => $value) {
            $directives[] = sprintf('%s %s', $name, $this->parseDirectiveValue($value));
        }

        if (!is_null($this->reflectedXssValue)) {
            $directives[] = sprintf('%s %s', 'reflected-xss', $this->reflectedXssValue);
        }

        if ($this->upgradeInsecureRequests) {
            $directives[] = $this->upgradeInsecureRequestsDirective;
        }

        if (!is_null($this->referrerValue)) {
            $directives[] = sprintf('%s %s', 'referrer', $this->referrerValue);
        }

        if (!is_null($this->reportUri)) {
            $directives[] = sprintf('%s %s', 'report-uri', $this->reportUri);
        }

        // No CSP policies set?
        if (count($directives) < 1) {
            return null;
        }

        return trim(sprintf('%s%s', implode($this->directiveSeparator, $directives), $this->directiveSeparator));
    }