function followReference(node) {
  var result;

  // immediate function
  if (testNode.isFunction(node)) {
    return node;
  }
  // follow identifier
  else {
    var name = node.name;

    // find the next highest scope and search for declaration
    while (node.parent && !result) {
      node = node.parent;
      var isBlock = testNode.isBlockOrProgram(node);
      if (isBlock) {

        // look at the nodes breadth first and take the first result
        esprimaTools.breadthFirst(node)
          .some(function eachNode(subNode) {
            switch (subNode.type) {
              case 'FunctionDeclaration':
                if (subNode.id.name === name) {
                  result = subNode;
                }
                break;
              case 'VariableDeclarator':
                if (subNode.id.name === name) {
                  result = subNode.init;
                }
                break;
              case 'AssignmentExpression':
                if ((subNode.left.type === 'Identifier') && (subNode.left.name === name)) {
                  result = subNode.right;
                }
                break;
            }
            return !!result;
          });
      }
    }

    // recurse the result until we find a function
    return result ? followReference(result) : null;
  }


}