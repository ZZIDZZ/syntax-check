function valueParserNodesLength (length, operator = '===') {
    return t.binaryExpression(
        operator,
        valueParserASTNodesLength,
        t.numericLiteral(length)
    );
}