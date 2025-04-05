function() {
          var promise;
          while (promise = queue.pop()) {
            promise.reject("flush");
          }
          while (promise = running.pop()) {
            promise.reject("flush");
          }
        }