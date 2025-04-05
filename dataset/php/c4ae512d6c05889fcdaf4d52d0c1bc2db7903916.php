public function getReturnType($name)
    {
        $container = new ReflectionClass($this);

        try {
            $method = $container->getMethod('get' . self::normalizeName($name));
            $doc    = $method->getDocComment();
            
            if (!empty($doc)) {
                preg_match('/@return ([a-zA-Z0-9_\x7f-\xff\x5c]+)/', $doc, $matches);

                if (isset($matches[1])) {
                    return $matches[1];
                }
            }
        } catch (ReflectionException $e) {
            // method does not exist
        }

        // as fallback we get the service and return the used type
        $service = $this->get($name);

        if (is_object($service)) {
            return get_class($service);
        } else {
            return gettype($service);
        }
    }