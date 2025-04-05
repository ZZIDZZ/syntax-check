public function isMatch(string $segmentValue, array &$routeVariables): bool
    {
        if ($this->onlyContainsVariable) {
            foreach ($this->parts[0]->rules as $rule) {
                if (!$rule->passes($segmentValue)) {
                    return false;
                }
            }

            $routeVariables[$this->parts[0]->name] = $segmentValue;

            return true;
        }

        $matches = [];

        if (\preg_match($this->regex, $segmentValue, $matches, PREG_UNMATCHED_AS_NULL) !== 1) {
            return false;
        }

        // Don't change the actual array until we're sure all the rules pass
        $routeVariablesCopy = $routeVariables;

        foreach ($this->parts as $part) {
            if ($part instanceof RouteVariable) {
                foreach ($part->rules as $rule) {
                    if (!$rule->passes($matches[$part->name])) {
                        return false;
                    }
                }

                $routeVariablesCopy[$part->name] = $matches[$part->name];
            }
        }

        $routeVariables = $routeVariablesCopy;

        return true;
    }