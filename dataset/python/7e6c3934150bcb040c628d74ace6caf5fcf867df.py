def ordereddict_push_front(dct, key, value):
    """Set a value at the front of an OrderedDict

    The original dict isn't modified, instead a copy is returned
    """
    d = OrderedDict()
    d[key] = value
    d.update(dct)
    return d