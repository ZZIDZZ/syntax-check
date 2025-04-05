function(latchFunction, optional_timeoutMessage, optional_timeout) {
  jasmine.getEnv().currentSpec.waitsFor.apply(jasmine.getEnv().currentSpec, arguments);
}