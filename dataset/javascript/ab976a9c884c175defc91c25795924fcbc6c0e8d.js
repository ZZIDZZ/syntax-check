function preorder(node, nodeIndex, parent) {
    var children
    var length
    var index
    var position
    var child

    if (is(test, node, nodeIndex, parent)) {
      return null
    }

    children = node.children

    if (!children || children.length === 0) {
      return node
    }

    // Move all living children to the beginning of the children array.
    position = 0
    length = children.length
    index = -1

    while (++index < length) {
      child = preorder(children[index], index, node)

      if (child) {
        children[position++] = child
      }
    }

    // Cascade delete.
    if (cascade && position === 0) {
      return null
    }

    // Drop other nodes.
    children.length = position

    return node
  }