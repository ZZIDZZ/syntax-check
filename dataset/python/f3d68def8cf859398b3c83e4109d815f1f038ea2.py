def ensure_iterable(inst):
    """
    Wraps scalars or string types as a list, or returns the iterable instance.
    """
    if isinstance(inst, str):
        return [inst]
    elif not isinstance(inst, collections.abc.Iterable):
        return [inst]
    else:
        return inst