public static <O> O parseArgumentsUsingInstance(final O options, final String... arguments)
            throws ArgumentValidationException, InvalidOptionSpecificationException
    {
        return createCliUsingInstance(options).parseArguments(arguments);
    }