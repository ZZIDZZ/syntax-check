function f(arr) {
     if(arr){
      var merged = [];
      return merged.concat.apply(merged, arr).join("")
      }
    }