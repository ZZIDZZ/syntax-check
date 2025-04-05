function describeModuleFactory (modulePath, specDefinitions) {
    return function () {
      beforeEach(function (done) {
        this.module = null;

        var requireCallback = function (module) {
          this.module = module;
          done();
        }.bind(this);

        require([modulePath], requireCallback);
      });

      specDefinitions.apply(this);
    };
  }