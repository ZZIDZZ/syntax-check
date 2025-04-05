function() {
      // Make sure a node version is intalled that satisfies
      // the projects required engine. If not, prompt to install.
      nvmLs('local', function() {
        var matches = semver.maxSatisfying(locals, expected);

        if (matches) {
          bestMatch = matches;
          nvmUse = nvmInit + 'nvm use ' + bestMatch;

          childProcess.exec(nvmUse, cmdOpts,function(err, stdout, stderr) {
            printVersion(stdout.split(' ')[3]);
            extendExec();
            checkPackages(options.globals);
          });
        } else {
          if (options.alwaysInstall) {
            nvmInstall();
          } else {
            askInstall();
          }
        }
      });
    }