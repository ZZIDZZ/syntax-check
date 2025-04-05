function (files) {
        if (!_.isArray(files)) {
            throw new Error('Arguments to config-helper.mergeConfig should be an array');
        }

        var appConfig = {};
        files.forEach(function (filePath) {
            if (gruntFile.exists(filePath)) {
                var fileConfig = gruntFile.readYAML(filePath);
                // Use lodash to do a 'deep merge' which only overwrites the properties
                // specified in previous config files, without wiping out their child properties.
                _.merge(appConfig, fileConfig);
            }
        });

        return appConfig;
    }