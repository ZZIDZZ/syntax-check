private function run($input)
    {
        foreach ($this->types as $name => $typeClass):

            //check if it custom type closure
            if (is_object($typeClass) && $typeClass instanceof Closure) {
                if ($typeClass($input) === true) {
                    return $name;
                }
                continue;
            }

        if ((new $typeClass())->sniff($input) === true) {
            return $name;
        }

        endforeach;
        //nothing captuared
        return 'unknown';
    }