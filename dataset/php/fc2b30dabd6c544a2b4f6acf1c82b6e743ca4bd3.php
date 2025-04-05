protected function process($content)
    {
        $parser = new Parser();
        
        $parser->addCodeDefinitionSet(new $this->defaultCodeDefinitionSet());

        // add definitions builder
        foreach ($this->codeDefinitionBuilder as $item) {
            if (is_string($item)) {
                $builder = new $item;
                if ($builder instanceof CodeDefinitionBuilder) {
                    $parser->addCodeDefinition($builder->build());
                }
            } elseif ($item instanceof CodeDefinitionBuilder) {
                $parser->addCodeDefinition($item->build());
            } elseif (is_callable($item)) {
                $parser->addCodeDefinition(call_user_func_array($item, [new CodeDefinitionBuilder('', '')]));  
            } elseif (isset($item[0]) && isset($item[1])) {
                $builder = new CodeDefinitionBuilder($item[0], $item[1]);
                $parser->addCodeDefinition($builder->build());
            }
        }       
        //added definitions set
        foreach ($this->codeDefinitionSet as $item) {
            if (is_string($item)) {
                $set = new $item;
                if ($set instanceof CodeDefinitionSet) {
                    $parser->addCodeDefinitionSet($set);
                }
            } elseif ($item instanceof CodeDefinitionSet) {
                $parser->addCodeDefinitionSet($item);
            }
        } 
        //added definitions
        foreach ($this->codeDefinition as $item) {
            if (is_string($item)) {
                $set = new $item;
                if ($set instanceof CodeDefinition) {
                    $parser->addCodeDefinition($set);
                }
            } elseif ($item instanceof CodeDefinition) {
                $parser->addCodeDefinition($item);
            }
        } 
        
        $parser->parse($content);
        
        if ($this->asHtml) {
            return $parser->getAsHtml();
        } 
        return $parser->getAsBBCode();
    }