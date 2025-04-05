def minimal_selector(self, complete_selector):
    """Returns the minimal selector that uniquely matches `complete_selector`.

    Args:
      complete_selector: A complete selector stored in the map.

    Returns:
      A partial selector that unambiguously matches `complete_selector`.

    Raises:
      KeyError: If `complete_selector` is not in the map.
    """
    if complete_selector not in self._selector_map:
      raise KeyError("No value with selector '{}'.".format(complete_selector))

    selector_components = complete_selector.split('.')
    node = self._selector_tree

    start = None
    for i, component in enumerate(reversed(selector_components)):
      if len(node) == 1:
        if start is None:
          start = -i  # Negative index, since we're iterating in reverse.
      else:
        start = None
      node = node[component]

    if len(node) > 1:  # The selector is a substring of another selector.
      return complete_selector
    return '.'.join(selector_components[start:])