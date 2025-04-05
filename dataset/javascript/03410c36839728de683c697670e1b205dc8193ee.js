function (data) {
    var config;

    // case data is argv string
    if (typeof data === "string") {
        // try to parse new version
        config = parseArgv(data);

        // its new config argv string
        if (Object.keys(config).length) {
            // translate short params to long one
            config.mode = config.mode || config.m;
            config.output = config.output || config.o;
            config.log = config.log || config.l;
            config.config = config.config || config.c;
            config['no-warn'] = config['no-warn'] || config['no-w'];
            config['source-map'] = config['source-map'] || config['sm'];
            config['source-map-root'] = config['source-map-root'] || config['sm-root'];
            config['source-map-www'] = config['source-map-www'] || config['sm-www'];
            config['source-map-inline'] = config['source-map-inline'] || config['sm-inline'];
        } else {
            // an old argv format, split argv and parse manually
            data = data.split(' ');

            // without mode
            if (availableModes.indexOf(data[2]) === -1) {
                config = {
                    mode: 'main',
                    config: data[2],
                    output: data[3]
                };
            } else { // with mode
                config = {
                    mode: data[2],
                    config: data[3],
                    output: data[4]
                };
            }
        }

    // case data is config object
    } else if (typeof config === "object") {
        // use as is
        config = data;

    // case else
    } else {
        // wut?
        throw new Error('Bad config data');
    }

    config.mode = config.mode || 'main';
    config.warn = !config['no-warn'];
    config.sourcemap = config['source-map'] || false;
    config.www_root = config['source-map-root'] || "";
    config.sourcemap_www = config['source-map-www'] || "";
    config.sourcemap_inline = config['source-map-inline'] || false;
    config.log = config.log || false;

    return config;
}