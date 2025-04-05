def compressed(self, new_type=None, *, include_ignored=False):
    """Turns the node into a value node, whose single string child is the concatenation of all its
    children.
    """
    values = []
    consumed = 0
    ignored = None

    for i, child in enumerate(self.children):
      consumed += child.consumed
      if i == 0 and not include_ignored:
        ignored = child.ignored
      if child.is_value:
        if include_ignored:
          values.append("{0}{1}".format(child.ignored or "", child.value))
        else:
          values.append(child.value)
      else:
        values.append(child.compressed(include_ignored=include_ignored).value)

    return ParseNode(new_type or self.node_type,
                      children=["".join(values)],
                      consumed=consumed,
                      ignored=ignored,
                      position=self.position)