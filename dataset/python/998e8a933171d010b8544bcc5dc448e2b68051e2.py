def diff(f, s):
    """
    Given two models, return the difference between them.

    Args:

        f (Pybindbase): First element.
        s (Pybindbase): Second element.

    Returns:

        dict: A dictionary highlighting the differences.

    Examples:

        >>> diff = napalm_yang.utils.diff(candidate, running)
        >>> pretty_print(diff)
        >>> {
        >>>     "interfaces": {
        >>>         "interface": {
        >>>             "both": {
        >>>                 "Port-Channel1": {
        >>>                     "config": {
        >>>                         "mtu": {
        >>>                             "first": "0",
        >>>                             "second": "9000"
        >>>                         }
        >>>                     }
        >>>                 }
        >>>             },
        >>>             "first_only": [
        >>>                 "Loopback0"
        >>>             ],
        >>>             "second_only": [
        >>>                 "Loopback1"
        >>>             ]
        >>>         }
        >>>     }
        >>> }
    """
    if isinstance(f, base.Root) or f._yang_type in ("container", None):
        result = _diff_root(f, s)
    elif f._yang_type in ("list",):
        result = _diff_list(f, s)
    else:
        result = {}
        first = "{}".format(f)
        second = "{}".format(s)
        if first != second:
            result = {"first": first, "second": second}

    return result