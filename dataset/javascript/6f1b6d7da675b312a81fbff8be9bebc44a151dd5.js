function Connection(uri, options) {
    var self = this;

    options || (options = {});
    options.autoReconnect != null || (options.autoReconnect = true);

    // It's a Db instance.
    if (uri.collection) {
        this.db = uri;
    } else {
        MongoClient.connect(uri, options, function (err, db) {
            if (err) return self.emit('error', err);
            self.db = db;
            self.emit('connect', db);
            db.on('error', function (err) {
                self.emit('error', err);
            });
        });
    }

    this.destroyed = false;
    this.channels = {};
}