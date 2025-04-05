def grouper(iterable, n, fillvalue=None):
    """Group iterable by n elements.

    >>> for t in grouper('abcdefg', 3, fillvalue='x'):
    ...     print(''.join(t))
    abc
    def
    gxx
    """
    return list(zip_longest(*[iter(iterable)] * n, fillvalue=fillvalue))