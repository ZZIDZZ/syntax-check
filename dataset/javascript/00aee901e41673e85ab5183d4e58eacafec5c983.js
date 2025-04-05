function _resolveIgnoreOpt(ignoreOpt) {
    if (!ignoreOpt) {
        return ignoreOpt;
    }

    var ignores = !_.isArray(ignoreOpt) ? [ignoreOpt] : ignoreOpt;

    return _.map(ignores, function(ignore) {
        var isRegex = ignore[0] === '/' && ignore[ignore.length - 1] === '/';
        if (isRegex) {
            // Convert user input to regex object
            var match = ignore.match(new RegExp('^/(.*)/(.*?)$'));
            return new RegExp(match[1], match[2]);
        }

        return ignore;
    });
}