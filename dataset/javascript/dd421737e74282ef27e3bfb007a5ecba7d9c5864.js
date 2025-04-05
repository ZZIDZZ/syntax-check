function Template(str, options) {

  // Handle the case where the only argument passed is the `options` object
  if(_.isObject(str) && !options){
    options = str;
    str = null;
  }

  // Create options if not provided
  options = options ? _.clone(options) : {};

  // Set default cache behavior
  // if node
  if(!_.isBoolean(options.cache)) {
    options.cache = process.env.NODE_ENV === 'production';
  }
  // end

  // Merges given `options` with `DEFAULTS`
  options = _.defaults(options, DEFAULTS);
  options.cacheContext = options.cacheContext || Template;

  // Sets instance variables
  this.template = str;
  this.options = options;
  this._compiled = null;

  // Creates the cache if not already done
  if(options.cache && !(this._getCache() instanceof options.cacheHandler)) {
    var cacheOptions = [options.cacheHandler].concat(options.cacheOptions);
    options.cacheContext[options._cacheProp] = typeof window !== 'undefined' ?
                                                 new options.cacheHandler() :
                                                 construct.apply(this,
                                                                 cacheOptions);
  }
}