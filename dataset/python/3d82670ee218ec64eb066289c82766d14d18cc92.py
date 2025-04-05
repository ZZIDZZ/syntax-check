def l(*members, meta=None) -> List:
    """Creates a new list from members."""
    return List(  # pylint: disable=abstract-class-instantiated
        plist(iterable=members), meta=meta
    )