function vuexEasyFirestore(easyFirestoreModule, _a) {
    var _b = _a === void 0 ? {
        logging: false,
        preventInitialDocInsertion: false,
        FirebaseDependency: Firebase$2
    } : _a, _c = _b.logging, logging = _c === void 0 ? false : _c, _d = _b.preventInitialDocInsertion, preventInitialDocInsertion = _d === void 0 ? false : _d, _e = _b.FirebaseDependency, FirebaseDependency = _e === void 0 ? Firebase$2 : _e;
    if (FirebaseDependency) {
        setFirebaseDependency(FirebaseDependency);
        setFirebaseDependency$1(FirebaseDependency);
    }
    return function (store) {
        // Get an array of config files
        if (!isWhat.isArray(easyFirestoreModule))
            easyFirestoreModule = [easyFirestoreModule];
        // Create a module for each config file
        easyFirestoreModule.forEach(function (config) {
            config.logging = logging;
            if (config.sync && config.sync.preventInitialDocInsertion === undefined) {
                config.sync.preventInitialDocInsertion = preventInitialDocInsertion;
            }
            var moduleName = vuexEasyAccess.getKeysFromPath(config.moduleName);
            store.registerModule(moduleName, iniModule(config, FirebaseDependency));
        });
    };
}