function qExec(command, options) {
    var d = Q.defer();

    exec(command, options, function(err, stdout, stderr) {
        if(err) {
            err.stdout = stdout;
            err.stderr = stderr;
            return d.reject(err);
        }
        return d.resolve(stdout, stderr);
    });

    return d.promise;
}