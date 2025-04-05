def _strip_tag(tree, tag):
    """
    Remove all tags that have the tag name ``tag``
    """
    for el in tree.iter():
        if el.tag == tag:
            el.getparent().remove(el)