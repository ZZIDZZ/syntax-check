function PromiseResolutionHandlerFunction () {
    return function F ( x ) {
      var promise = F['[[Promise]]'],
        fulfillmentHandler = F['[[FulfillmentHandler]]'],
        rejectionHandler = F['[[RejectionHandler]]'],
        selfResolutionError, C, promiseCapability, updateResult;
      if ( SameValue(x, promise) ) {
        selfResolutionError = TypeError();
        return rejectionHandler.call(undefined, selfResolutionError);
      }
      C = promise['[[PromiseConstructor]]'];
      try {
        promiseCapability = NewPromiseCapability(C);
      } catch ( e ) {
        return e;
      }
      try {
        updateResult = UpdatePromiseFromPotentialThenable(x,
          promiseCapability
        );
      } catch ( e ) {
        return e;
      }
      if ( updateResult !== 'not a thenable') {
        return promiseCapability['[[Promise]]'].then(fulfillmentHandler,
          rejectionHandler
        );
      }
      return fulfillmentHandler.call(undefined, x);
    };
  }