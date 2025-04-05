def _mergedict(a, b):
    """Recusively merge the 2 dicts.

    Destructive on argument 'a'.
    """
    for p, d1 in b.items():
        if p in a:
            if not isinstance(d1, dict):
                continue
            _mergedict(a[p], d1)
        else:
            a[p] = d1
    return a