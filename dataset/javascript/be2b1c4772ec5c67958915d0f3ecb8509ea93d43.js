function(folderName, task) {
    var defer = Q.defer();

    var vn = (task.name || folderName);

    if (!task.id || !check.isUUID(task.id)) {
        defer.reject(createError(vn + ': id is a required guid'));
    };

    if (!task.name || !check.isAlphanumeric(task.name)) {
        defer.reject(createError(vn + ': name is a required alphanumeric string'));
    }

    if (!task.friendlyName || !check.isLength(task.friendlyName, 1, 40)) {
        defer.reject(createError(vn + ': friendlyName is a required string <= 40 chars'));
    }

    if (!task.instanceNameFormat) {
        defer.reject(createError(vn + ': instanceNameFormat is required'));    
    }

    // resolve if not already rejected
    defer.resolve();
    return defer.promise;
}