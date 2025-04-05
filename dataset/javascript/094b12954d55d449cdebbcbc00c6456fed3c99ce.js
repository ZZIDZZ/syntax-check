function appendCurrentTree(info) {
    if (isNodeDroppable(info.currentTree.rootData)) {
      th.appendTo(info.dplh, info.currentTree.rootData);
    }
  }