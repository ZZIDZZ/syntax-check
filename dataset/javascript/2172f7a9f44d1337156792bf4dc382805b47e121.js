function config(path, val){
    if(!path) return options; /**@todo: probably a deep copy */
    if(!angoose.initialized && typeof(path) == 'string') throw "Cannot call config(" + path+") before angoose is intialized";
    //if(angoose.initialized && typeof(conf) == 'object') throw "Cannot config Angoose after startup";
    
    if(typeof (path) === 'string'){
         if(val === undefined)
            return toolbox.getter(options, path);
         toolbox.setter(options, path, val);
    }
    
    if(typeof(path) === 'object'){
        // deep merge
        options = toolbox.merge(options, path);

    }
}