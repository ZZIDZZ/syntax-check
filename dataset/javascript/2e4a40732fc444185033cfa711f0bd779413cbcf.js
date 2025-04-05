function(options) {
    this._handlers = {
        'progress': [],
        'cancel': [],
        'error': [],
        'complete': []
    };

    // require options parameter
    if (typeof options === 'undefined') {
        throw new Error('The options argument is required.');
    }

    // require options.src parameter
    if (typeof options.src === 'undefined' && options.type !== "local") {
        throw new Error('The options.src argument is required for merge replace types.');
    }

    // require options.id parameter
    if (typeof options.id === 'undefined') {
        throw new Error('The options.id argument is required.');
    }

    // define synchronization strategy
    //
    //     replace: This is the normal behavior. Existing content is replaced
    //              completely by the imported content, i.e. is overridden or
    //              deleted accordingly.
    //     merge:   Existing content is not modified, i.e. only new content is
    //              added and none is deleted or modified.
    //     local:   Existing content is not modified, i.e. only new content is
    //              added and none is deleted or modified.
    //
    if (typeof options.type === 'undefined') {
        options.type = 'replace';
    }

    if (typeof options.headers === 'undefined') {
        options.headers = null;
    }

    if (typeof options.copyCordovaAssets === 'undefined') {
        options.copyCordovaAssets = false;
    }

    if (typeof options.copyRootApp === 'undefined') {
        options.copyRootApp = false;
    }

    if (typeof options.timeout === 'undefined') {
        options.timeout = 15.0;
    }

    if (typeof options.trustHost === 'undefined') {
        options.trustHost = false;
    }

    if (typeof options.manifest === 'undefined') {
        options.manifest = "";
    }

    if (typeof options.validateSrc === 'undefined') {
        options.validateSrc = true;
    }

    // store the options to this object instance
    this.options = options;

    // triggered on update and completion
    var that = this;
    var success = function(result) {
        if (result && typeof result.progress !== 'undefined') {
            that.emit('progress', result);
        } else if (result && typeof result.localPath !== 'undefined') {
            that.emit('complete', result);
        }
    };

    // triggered on error
    var fail = function(msg) {
        var e = (typeof msg === 'string') ? new Error(msg) : msg;
        that.emit('error', e);
    };

    // wait at least one process tick to allow event subscriptions
    setTimeout(function() {
        exec(success, fail, 'Sync', 'sync', [options.src, options.id, options.type, options.headers, options.copyCordovaAssets, options.copyRootApp, options.timeout, options.trustHost, options.manifest, options.validateSrc]);
    }, 10);
}