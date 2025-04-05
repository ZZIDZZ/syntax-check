def get(value):
    "Query to get the value."
    if not isinstance(value, Token):
        raise TypeError('value must be a token')

    if not hasattr(value, 'identifier'):
        raise TypeError('value must support an identifier')

    if not value.identifier:
        value = value.__class__(**value.__dict__)
        value.identifier = 'v'

    ident = Identifier(value.identifier)

    return Query([
        Match(value),
        Return(ident)
    ])