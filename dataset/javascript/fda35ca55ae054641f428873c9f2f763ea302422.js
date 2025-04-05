function getOverrides(backend, file, cb) {
  async.parallel([
    function hierarchy(cb) {
      getHierarchy(cb);
    },

    function backendConfig(cb) {
      getBackendConfig(backend, cb);
    }
  ], function (err, results) {
    var hierarchy, datadir, filename, tasks,
        pos, searchHierarchy, tasks;

    hierarchy = results[0];
    datadir   = results[1][':datadir'];
    filename  = file.remove('.' + backend);
    tasks     = [];

    // remove the file's matching hierarchy
    pos = hierarchy.findIndex(filename);
    searchHierarchy = hierarchy.to(pos);

    getFile(backend, file, function (err, data) {
      var sourceData;

      if (err) {
        cb(err);
        return;
      }

      sourceData = yaml.safeLoad(data);

      // setup hierarchy search tasks
      _.each(searchHierarchy, function (hierarchy) {
        tasks.push(hierarchy + '.' + backend);
      });

      async.map(tasks, function (f, cb) {
        // get data for each file in the hierarchy
        // TODO: support magic hiera vars
        getFile(backend, f, function (err, data) {
          cb(null, {
            file : f,
            data : yaml.safeLoad(data)
          });
        });
      }, function (err, comparisonData) {
        var list = {};

        if (err) {
          cb(err);
          return;
        }

        _.each(sourceData, function (key, value) {
          _.each(comparisonData, function (set) {
            _.each(set.data, function (cKey, cValue) {
              if (cKey === key) {
                list[cKey] = {
                  file  : set.file,
                  value : cValue
                };
              }
            });

            if (list[key]) {
              // already exists
              return false;
            }
          });
        });

        cb(null, list);
      });
    });
  });
}