function fiberize(fn){
  return function(done){

    var self = this;
    Fiber(function(){

      try{
        if(fn.length == 1){
          fn.call(self, done);
        } else {
          fn.call(self);
          done();
        }
      } catch(e) {
        process.nextTick(function(){
          throw(e);
        });
      }

    }).run();

  };
}