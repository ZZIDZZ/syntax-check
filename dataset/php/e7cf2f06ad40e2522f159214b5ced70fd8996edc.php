public function classNames(...$arguments)
    {
        $classNames = [];
        foreach ($arguments as $argument) {
            if ((bool)$argument === true) {
                if (is_array($argument)) {
                    $keys = array_keys($argument);
                    $isAssoc = array_keys($keys) !== $keys;
                    if ($isAssoc) {
                        foreach ($argument as $className => $condition) {
                            if ((bool)$condition === true) {
                                $classNames[] = (string)$className;
                            }
                        }
                    } else {
                        foreach ($argument as $className) {
                            if (is_scalar($className) && !!is_bool($condition) && (bool)$className === true) {
                                $classNames[] = (string)$className;
                            }
                        }
                    }
                } elseif (is_scalar($argument) && !is_bool($argument)) {
                    $classNames[] = (string)$argument;
                }
            }
        }
        return implode(' ', $classNames);
    }