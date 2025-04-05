function traverse(node, opt_onEnter, opt_onLeave) {
  if (opt_onEnter) opt_onEnter(node);

  var childNodes = _collectChildNodes(node);
  childNodes.forEach(function(childNode) {
    traverse(childNode, opt_onEnter, opt_onLeave);
  });

  if (opt_onLeave) opt_onLeave(node);
}