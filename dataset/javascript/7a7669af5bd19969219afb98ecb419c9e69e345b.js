function concatOptionDataArrays(options, data, prop) {
    if (!_.has(options, prop) && !_.has(data, prop)) {
        return;
    }

    var combined = [];
    if (_.isArray(options[prop])) {
        combined = combined.concat(options[prop]);
    }
    if (_.isArray(data[prop])) {
        combined = combined.concat(data[prop]);
    }
    options[prop] = combined;
}