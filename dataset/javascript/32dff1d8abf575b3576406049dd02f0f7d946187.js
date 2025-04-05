function(sourceFunc, boundFunc, context, callingContext, args) {
    if (!(callingContext instanceof boundFunc)) return sourceFunc.apply(context, args);
    Ctor.prototype = sourceFunc.prototype;
    var self = new Ctor;
    Ctor.prototype = null;
    var result = sourceFunc.apply(self, args);
    if (_.isObject(result)) return result;
    return self;
  }