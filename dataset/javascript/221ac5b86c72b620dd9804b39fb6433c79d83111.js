function assignOptions(defaults, userDefined) {
        for (const optionKey in userDefined) {
            if (defaults.hasOwnProperty(optionKey)) {
                defaults[optionKey] = userDefined[optionKey];
            }
            else {
                throw new Error(`Unknown {IOptions} parameter '${optionKey}'`);
            }
        }
        return defaults;
    }