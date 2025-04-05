def method(dispatch_fn, dispatch_key=None):
    """A decorator for a function implementing dispatch_fn for dispatch_key.

    If no dispatch_key is specified, the function is used as the
    default dispacth function.
    """

    def apply_decorator(fn):
        if dispatch_key is None:
            # Default case
            dispatch_fn.__multi_default__ = fn
        else:
            dispatch_fn.__multi__[dispatch_key] = fn
        return fn

    return apply_decorator