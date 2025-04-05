function (nextTargetFn, fnOpt) {
      tail.next = {
        fns: [nextTargetFn],
        opts: [fnOpt]
      };
      tail = tail.next;
      dispatch();
      return controller;
    }