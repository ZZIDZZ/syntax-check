function DockerCmdManager(dockerdescPath) {
    dockerdescPath = dockerdescPath || './dockerdesc.json';

    if (!fs.existsSync(dockerdescPath)) {
        throw new Error(util.format('The path "%s" does not exists.', dockerdescPath));
    }
    /** @type {string} */
    this.dockerdescDir = path.dirname(dockerdescPath);

    var dockerdescPathStat = fs.statSync(dockerdescPath);
    if (dockerdescPathStat.isDirectory()) {
        this.dockerdescDir = dockerdescPath;
        dockerdescPath = path.join(dockerdescPath, 'dockerdesc.json');
    }
    /** @type {Dockerdesc} */
    var dockerdescContent = fs.readFileSync(dockerdescPath);
    try {
        this.dockerdesc = JSON.parse(dockerdescContent);
    } catch (err) {
        throw new Error('Problem in the dockerdesc.json file format.\n' + err.stack);
    }
}