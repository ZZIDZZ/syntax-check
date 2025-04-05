function(result) {
                var callback = arguments[arguments.length - 1];
                grunt.log.debug('finish grunt task');

                if (isLastTask) {

                    // close the file if it was opened
                    if (fd) {
                        fs.closeSync(fd);
                    }

                    // Restore process.stdout.write to its original value
                    hooker.unhook(process.stdout, 'write');

                }

                done(result);
                callback();
            }