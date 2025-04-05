def deprecated_func(func):
    """Deprecates a function, printing a warning on the first usage."""

    # We use a mutable container here to work around Py2's lack of
    # the `nonlocal` keyword.
    first_usage = [True]

    @functools.wraps(func)
    def wrapper(*args, **kwargs):
        if first_usage[0]:
            warnings.warn(
                "Call to deprecated function {}.".format(func.__name__),
                DeprecationWarning,
            )
            first_usage[0] = False
        return func(*args, **kwargs)

    return wrapper