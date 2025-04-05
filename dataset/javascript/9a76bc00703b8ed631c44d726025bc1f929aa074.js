function formatWith(options) {
        options = Object.assign({}, DEFAULTS, options);
        return (message, ...args) => {
            return _formatter(options, message, ...args);
        };
    }