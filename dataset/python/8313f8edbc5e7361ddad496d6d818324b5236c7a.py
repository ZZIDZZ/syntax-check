def debugger():
    """If called in the context of an exception, calls post_mortem; otherwise
    set_trace.
    ``ipdb`` is preferred over ``pdb`` if installed.
    """
    e, m, tb = sys.exc_info()
    if tb is not None:
        _debugger.post_mortem(tb)
    else:
        _debugger.set_trace()