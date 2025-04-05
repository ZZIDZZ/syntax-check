public function setValue(AssignableNode $value)
    {
        // we currently only allow Arrays & scalar values
        // it not yet possible assign a reference to a parameter
        if (!($value instanceof ValueNode || $value instanceof ArrayNode)) {
            throw new LogicalNodeException("It is not possible to pass a reference of a parameter or service to a parameter definition.");
        }

        $this->value = $value;
    }