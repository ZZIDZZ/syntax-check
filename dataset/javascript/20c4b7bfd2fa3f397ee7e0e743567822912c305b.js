function inspectContainer(container_path, opts) {
    return new Promise(function(resolve, reject) {
            if(path.extname(container_path) !== '.' + spec.file_ext) {
                reject(new Error('Invalid resource container file extension'));
                return;
            }
            try {
                resolve(fs.statSync(container_path).isFile());
            } catch(err) {
                reject(new Error('The resource container does not exist at', container_path));
            }
        })
        .then(function(isFile) {
            if(isFile) {
                // TODO: For now we are just opening the container then closing it.
                // Eventually it would be nice if we can inspect the archive without extracting everything.
                let containerDir = path.join(path.dirname(container_path), path.basename(container_path, '.' + spec.file_ext));
                return openContainer(container_path, containerDir, opts)
                    .then(function(container) {
                        return closeContainer(containerDir, opts)
                            .then(function() {
                                return Promise.resolve(container.info);
                            });
                    });
            } else {
                loadContainer(container_path)
                    .then(function(container) {
                        return Promise.resolve(container.info);
                    });
            }
        });
}