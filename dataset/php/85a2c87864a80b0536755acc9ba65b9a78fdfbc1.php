public function listAvailableMethods($customMethods = null)
    {
        echo "Available methods are:\n";
        foreach ($this->getAvailableMethods($customMethods ?: $this->getCustomMethods()) as $method) {
            $action = $this->convertToKebabCase($method);
            $target = isset($this->methods[$method]) ? $this->methods[$method] : $method;
            $key = array_search($target, $this->methods);
            if (is_int($key)) {
                $key = $this->methods[$key];
            }

            echo ' - '.$action.($key && $key !== $method
                    ? ' ('.$this->convertToKebabCase($key).' alias)'
                    : ''
                )."\n";
        }
    }