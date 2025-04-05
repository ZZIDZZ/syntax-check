public static boolean isConstant(String expression, Map context)
            throws OgnlException
    {
        return isConstant(parseExpression(expression), context);
    }