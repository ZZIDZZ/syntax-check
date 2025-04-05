function( performer ) {
  // everything checks out
  var state = performer.state;
  
  // everything resolved
  if ( state.allCount === 0 ) {

    var args = [];
    for ( var i = 0; i < performer.args.length; i++ ) {
      args = args.concat( [].concat( performer.args[i].args ) );
    }
    // either fail/done are 0 or something went wrong
    if ( state.targetCount === 0 ) {
      performer._dfd.resolve.apply ( performer._dfd, args );
    } else {
      performer._dfd.reject.apply( performer._dfd, args );
    }
  }
}