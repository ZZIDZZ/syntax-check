def short_description(func):
    """
    Given an object with a docstring, return the first line of the docstring
    """

    doc = inspect.getdoc(func)
    if doc is not None:
        doc = inspect.cleandoc(doc)
        lines = doc.splitlines()
        return lines[0]

    return ""