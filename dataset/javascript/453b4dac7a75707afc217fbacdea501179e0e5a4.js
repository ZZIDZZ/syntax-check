function run(inch_args, options) {
  var callback = function(filename) {
      LocalInch.run(inch_args || ['suggest'], filename, noop);
    }

  if( options.dry_run ) callback = noop;
  retriever.run(PathExtractor.extractPaths(inch_args), callback);
}