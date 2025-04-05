static public function valueForKeyPathOfObject($keyPath, $object, $default = null)
    {
        $i = 0;
        $keyPathParts = explode('.', $keyPath);
        $keyPathPartsLength = count($keyPathParts);
        $currentValue = $object;

        if (!is_string($keyPath)) {
            throw new \LogicException(
                'Given key path is not of type string (maybe arguments are ordered incorrect)',
                1395484136
            );
        }

        for ($i = 0; $i < $keyPathPartsLength; $i++) {
            $key = $keyPathParts[$i];
            $accessorMethod = 'get' . ucfirst($key);

            switch (true) {
                // Current value is an array
                case is_array($currentValue) && isset($currentValue[$key]):
                    $currentValue = $currentValue[$key];
                    break;

                // Current value is an object
                case is_object($currentValue):
                    if (method_exists($currentValue, $accessorMethod)) { // Getter method
                        $currentValue = $currentValue->$accessorMethod();
                    } else {
                        if (method_exists($currentValue, 'get')) { // General "get" method
                            $currentValue = $currentValue->get($key);
                        } else {
                            if (in_array($key, get_object_vars($currentValue))) { // Direct access
                                $currentValue = $currentValue->$key;
                            } else {
                                $currentValue = null;
                            }
                        }
                    }
                    break;

                default:
                    $currentValue = null;
            }

            if ($currentValue === null) {
                break;
            }
        }

        if ($i !== $keyPathPartsLength && func_num_args() > 2) {
            if (is_object($default) && ($default instanceof \Closure)) {
                $currentValue = $default();
            } else {
                $currentValue = $default;
            }
        }

        return $currentValue;
    }