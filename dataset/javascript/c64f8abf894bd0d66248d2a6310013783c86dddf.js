function clear(except, options) {
  var keys = this.get(), z;
  except = except || [];
  for(z in keys) {
    if(~except.indexOf(z)) {
      continue;
    }
    this.del(z, options);
  }
}