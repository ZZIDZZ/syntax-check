function sshCommandSequence(connection, commands, fnOutput) {

  var allResults = [];
  var successHandler = function(nextPromise){
    return function(result) {
      if( result !== true) {  // the first result must be ignored
        allResults.push(result);
      }
      return nextPromise();
    };
  };

  var errorHandler = function(nextPromise) {
    return function(error) {
      allResults.push(error);
      return nextPromise();
    };
  };

  // start the sequential fullfilment of the Promise chain
  // The first result (true) will not be inserted in the result array, it is here
  // just to start the chain.
  var result = Q(true);
  commands.map(function(command){
    return function() {
			return sshExecSingleCommand(connection, command, fnOutput);
		};
  }).forEach(function (f) {
    result = result.then(
      successHandler(f),
      errorHandler(f)
    );
  });

  // As the last result is not handled in the forEach loop, we must handle it now
  return result.then(
  	function(finalResult){
      allResults.push(finalResult);
      return allResults;
    },
    function(error) {
      allResults.push(error);
      return allResults;
  });
}