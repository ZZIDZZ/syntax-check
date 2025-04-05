function global(map){
    Object.keys(map).forEach(function(key){
        var file = map[key],
            arr = file.split('#'),
            mdl = require('./lib/'+arr[0]+'.js');
        // for util/logger#Logger
        if (!!arr[1]){
            // for util/logger#level,logger
            var brr = arr[1].split(',');
            if (brr.length>1){
                var ret = {};
                brr.forEach(function(name){
                    ret[name] = mdl[name];
                });
                mdl = ret;
            }else{
                mdl = mdl[brr[0]];
            }
        }
        exports[key] = mdl;
    });
}