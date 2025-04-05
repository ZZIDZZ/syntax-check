private function replaceConfigValuePlaceholders($value)
    {
        if (is_array($value)) {
            foreach ($value as $subKey => $subValue) {
                $value[$subKey] = $this->replaceConfigValuePlaceholders($subValue);
            }
        } else {
            // replace environment variable
            if (preg_match(self::ENV_PARAMETER_PATTERN, $value, $matches)) {
                $envValue = getenv($matches[1]);
                if ($envValue === false) {
                    throw new \RuntimeException(sprintf(
                        'No environment variable found with name %s',
                        $matches[1]
                    ));
                }

                $value = $envValue;
            }
        }

        return $value;
    }