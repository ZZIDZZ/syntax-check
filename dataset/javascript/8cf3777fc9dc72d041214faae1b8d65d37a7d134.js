function treeDistance(a, b) {
  if (a === b) return 0;
  var parent = commonParent(a, b);

  var aParent = a;
  var aCount = 0;

  var bParent = b;
  var bCount = 0;

  if (parent !== a) {
    while (parent !== aParent.parent) {
      aCount += 1;
      aParent = aParent.parent;
    }
  } else {
    bCount += 1;
  }

  if (parent !== b) {
    while (parent !== bParent.parent) {
      bCount += 1;
      bParent = bParent.parent;
    }
  } else {
    aCount += 1;
  }

  var abCount = 0;
  if (parent !== a && parent !== b) {
    abCount = Math.abs(
      parent.children.indexOf(aParent) - parent.children.indexOf(bParent)
    );
  }

  return aCount + bCount + abCount;
}