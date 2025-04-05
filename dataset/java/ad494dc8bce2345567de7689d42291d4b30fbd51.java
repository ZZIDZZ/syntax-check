public Iterable<Map<String, Variable>> expandResultSetToMap(Iterator<Set<Variable>> solutions)
    {
        return new Filterator<Set<Variable>, Map<String, Variable>>(solutions,
            new Function<Set<Variable>, Map<String, Variable>>()
            {
                public Map<String, Variable> apply(Set<Variable> variables)
                {
                    Map<String, Variable> results = new HashMap<String, Variable>();

                    for (Variable var : variables)
                    {
                        String varName = getInterner().getVariableName(var.getName());
                        results.put(varName, var);
                    }

                    return results;
                }
            });
    }