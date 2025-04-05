function continuable(func, context) {
      ensureFunc(func, 'function');

      if (context) { // TODO: Handle falsy things?
        func = bind(func, context);
      }

      steps.push(func);
      return continuable;
    }