function checkCallExpression(node) {
  var callee = node.callee;
  if (callee.type === 'Identifier' && callee.name === 'require') {
    var pathNode = node.arguments[0];
    if (pathNode.type === 'Literal') {
      var p = pathNode.value;

      // Only check relatively-imported modules.
      if (startswith(p, ['/', './', '../'])) {
        return !endswith(p, '.js');
      }
    }
  }
  return true;
}