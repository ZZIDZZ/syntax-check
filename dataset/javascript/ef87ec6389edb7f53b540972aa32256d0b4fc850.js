function(){
    var z = this;
    var l = 0;
    Object.keys(z.tails).forEach(function(k) {
      l += (z.tails[k].buf||'').length;
    });
    return l;
  }