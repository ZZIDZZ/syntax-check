function checkFunction(node)
    {
        const functionConfig = getConfigForFunction(node);
        if (functionConfig === 'ignore')
            return;
        const rightToken = sourceCode.getFirstToken(node, astUtils.isOpeningParenToken);
        const leftToken = sourceCode.getTokenBefore(rightToken);
        const text =
        sourceCode
        .text
        .slice(leftToken.range[1], rightToken.range[0])
        .replace(/\/\*[^]*?\*\//g, '');
        if (astUtils.LINEBREAK_MATCHER.test(text))
            return;
        const hasSpacing = /\s/.test(text);
        if (hasSpacing && functionConfig === 'never')
        {
            const report =
            {
                node,
                loc: leftToken.loc.end,
                message: 'Unexpected space before function parentheses.',
                fix: fixer => fixer.removeRange([leftToken.range[1], rightToken.range[0]]),
            };
            context.report(report);
        }
        else if (!hasSpacing && functionConfig === 'always')
        {
            const report =
            {
                node,
                loc: leftToken.loc.end,
                message: 'Missing space before function parentheses.',
                fix: fixer => fixer.insertTextAfter(leftToken, ' '),
            };
            context.report(report);
        }
    }