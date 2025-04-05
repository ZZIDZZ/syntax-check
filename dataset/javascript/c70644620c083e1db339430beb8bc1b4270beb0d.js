function (filePath) {
                let standerPath = filePath.replace(/\\/g, '/');
                oss.deleteObject({
                    Bucket: bucket.Name,
                    Key: standerPath
                }, function (err) {
                    if (err) {
                        console.log('error:', err);
                        return err;
                    }
                    let bucketIndex = bucketPaths.indexOf(standerPath);
                    if (bucketIndex !== -1) {
                        bucketPaths.splice(bucketIndex, 1);
                    }
                    let localIndex = localPaths.indexOf(standerPath);
                    if (localIndex !== -1) {
                        localPaths.splice(localIndex, 1);
                    }
                    console.log('delete success:' + standerPath);
                });
            }