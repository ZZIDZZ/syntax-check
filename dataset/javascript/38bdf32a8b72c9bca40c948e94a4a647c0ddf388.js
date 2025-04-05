function() {
    var appEnv = this.app.env;
    if (process.env.DEPLOY_TARGET) {
      appEnv = process.env.DEPLOY_TARGET;
    }
    var publicFiles = new Funnel(this.app.trees.public);

    this._requireBuildPackages();

    fs.stat(
      path.join(this.project.root, 'public', 'robots.txt'),
      function(err, stats) {
        if (stats && stats.isFile()) {
          console.log(chalk.yellow('There is a robots.txt in /public and ENV specific robots.txt are ignored!'));
        }
      }
    );

    publicFiles = stew.rename(
      publicFiles,
      'robots-' + appEnv + '.txt',
      'robots.txt'
    );

    return new Funnel(publicFiles, {
      srcDir: '/',
      destDir: '/'
    });
  }