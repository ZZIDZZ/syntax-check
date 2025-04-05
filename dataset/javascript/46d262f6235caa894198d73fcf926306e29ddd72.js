function(err) {
        if (err) {
          // eslint-disable-next-line no-console
          console.log('\n');
          return Promise.reject(err);
        }

        if (retryFilesCountDown < 0) retryFilesCountDown = 0;

        // Get batch files
        let _files = retryFiles.splice(
          0,
          batch <= retryFilesCountDown ? batch : retryFilesCountDown
        );
        retryFilesCountDown = retryFilesCountDown - _files.length;


        if (_files.length) {
          return Promise.all(
            _files.map(file => performUpload(file, true))
          ).then(() => retryFailedFiles(), retryFailedFiles);
        } else {
          if (retryFiles.length) {
            return Promise.reject(new Error('File uploaded failed'));
          } else {
            return Promise.resolve();
          }
        }
      }