function doSpawn(method, command, args, options) {
    var result = {};

    var cp;
    var cpPromise = new ChildProcessPromise();
    var reject = cpPromise._cpReject;
    var resolve = cpPromise._cpResolve;

    var successfulExitCodes = (options && options.successfulExitCodes) || [0];

    cp = method(command, args, options);

    // Don't return the whole Buffered result by default.
    var captureStdout = false;
    var captureStderr = false;

    var capture = options && options.capture;
    if (capture) {
        for (var i = 0, len = capture.length; i < len; i++) {
            var cur = capture[i];
            if (cur === 'stdout') {
                captureStdout = true;
            } else if (cur === 'stderr') {
                captureStderr = true;
            }
        }
    }

    result.childProcess = cp;

    if (captureStdout) {
        result.stdout = '';

        cp.stdout.on('data', function(data) {
            result.stdout += data;
        });
    }

    if (captureStderr) {
        result.stderr = '';

        cp.stderr.on('data', function(data) {
            result.stderr += data;
        });
    }

    cp.on('error', reject);

    cp.on('close', function(code) {
        if (successfulExitCodes.indexOf(code) === -1) {
            var commandStr = command + (args.length ? (' ' + args.join(' ')) : '');
            var message = '`' + commandStr + '` failed with code ' + code;
            var err = new ChildProcessError(message, code, cp);

            if (captureStderr) {
                err.stderr = result.stderr.toString();
            }

            if (captureStdout) {
                err.stdout = result.stdout.toString();
            }

            reject(err);
        } else {
            result.code = code;
            resolve(result);
        }
    });

    cpPromise.childProcess = cp;

    return cpPromise;
}