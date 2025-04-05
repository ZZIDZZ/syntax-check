function executeExtensions(hook, args) {
        var i,
            extensions = hooks[hook] || [],
            len = extensions.length;

        for (i = 0; i < len; i += 1) {
            extensions[i].apply(null, args);
        }
    }