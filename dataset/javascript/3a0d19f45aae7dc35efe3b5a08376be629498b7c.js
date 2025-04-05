function getContext(context, pathInfo) {
      var globalContext,
          templateContext;

      try {
        globalContext = grunt.file.readJSON(path.join(options.templatesDir, "global.json"));
      } catch(err) {
        globalContext = {};
      }
      try {
        templateContext = grunt.file.readJSON(path.join(pathInfo.dirName, pathInfo.outfileName) + ".json");
      } catch(err) {
        templateContext = {};
      }
      return _.extend({}, globalContext, templateContext, options.defaultContext, context);
    }