def get_version(version=None):
    """
    Return full version nr, inc. rc, beta etc tags.

    For example: `2.0.0a1`
    :rtype: str
    """
    v = version or __version__
    if len(v) == 4:
        return '{0}{1}'.format(short_version(v), v[3])

    return short_version(v)