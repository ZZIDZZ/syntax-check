function(obj, array){
    if(!Array.prototype.indexOf){
      for(var i=0; i<array.length; i++){
          if(array[i]===obj){
              return i;
          }
      }
      return -1;
    }
    else {
      return array.indexOf(obj); 
    }
  }