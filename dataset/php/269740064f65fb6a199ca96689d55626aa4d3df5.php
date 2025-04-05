protected function checkClassExists($className, $throwException = true)
    {
        if (class_exists($className)) {
            return true;
        }

        if ($throwException) {
            throw new \BadMethodCallException(
                sprintf('%s not found. Please check your dependencies in composer.json', $className)
            );
        }

        return false;
    }