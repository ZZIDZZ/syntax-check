private function convertArrayOfReflectionToSelf(array $reflectionClasses): array
    {
        $return = [];
        foreach ($reflectionClasses as $key => $reflectionClass) {
            $return[$key] = self::constructFromReflectionClass($reflectionClass);
        }

        return $return;
    }