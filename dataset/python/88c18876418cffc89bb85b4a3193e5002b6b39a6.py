def _serialize(xp_ast):
    '''Generate token strings which, when joined together, form a valid
    XPath serialization of the AST.'''

    if hasattr(xp_ast, '_serialize'):
        for tok in xp_ast._serialize():
            yield(tok)
    elif isinstance(xp_ast, str):
        yield(repr(xp_ast))