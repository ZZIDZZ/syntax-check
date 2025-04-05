boolean pushVariableReference(String name) {
        if (!isParserTranslationEnabled()) {
            return push(new SimpleNode(name));
        }

        // Walk down the stack, looking for a scope node that knows about a given variable
        for (Node node : getContext().getValueStack()) {
            if (!(node instanceof ScopeNode)) {
                continue;
            }

            // Ensure that the variable exists
            ScopeNode scope = (ScopeNode) node;
            if (!scope.isVariableDefined(name)) {
                continue;
            }

            return push(new VariableReferenceNode(name));
        }

        // Record error location
        throw new UndefinedVariableException(name);
    }