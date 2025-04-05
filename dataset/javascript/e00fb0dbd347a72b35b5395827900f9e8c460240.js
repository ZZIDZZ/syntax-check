function usage(gulp, options) {
    // re-define options if needed
    if (options) {
        Object.assign(OPTIONS, options);
    }

    return new Promise(function(resolve) {
        build(gulp);
        print();
        resolve();
    });
}