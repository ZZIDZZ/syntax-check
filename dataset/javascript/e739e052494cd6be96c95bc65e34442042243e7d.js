function addEventHandlers(self){
    self.on('error',function(d){
        var fn = self._error;
        self._cleanUp();
        if(fn){
            fn('pipeline[' + self._nr + ']:"' + self._command + '" failed with: ' + d.toString());
        }
    });
}