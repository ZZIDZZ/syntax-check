function writeFileP (outputPath, data, cb) {
    outputPath = abs(outputPath);
    let dirname = path.dirname(outputPath);
    mkdirp(dirname, err => {
        if (err) { return cb(err); }
        let str = data;
        if (typpy(data, Array) || typpy(data, Object)) {
            str = JSON.stringify(data, null, 2);
        }
        fs.writeFile(outputPath, str, err => cb(err, data));
    });
}