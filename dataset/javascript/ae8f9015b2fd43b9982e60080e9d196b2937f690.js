function assign(parent, val, keyOpts) {
  var target   = parent,
      keyParts = keyOpts.val.toString().split('.');
   
  keyParts.forEach(function(keyPart, idx) {
    if (keyParts.length === idx + 1) {
      if (val !== undefined) {
        if (Array.isArray(val) && Array.isArray(target[keyPart])) {
          val = target[keyPart].concat(val);
        }
        
        if (!((Array.isArray(val) && !val.length) 
          || (typeof val === 'object' && !Object.keys(val || {}).length))) {        
            target[keyPart] = val;        
        }
      }
    } else if (!(keyPart in target)) {      
      target[keyPart] = {};
    }    
  });  
}