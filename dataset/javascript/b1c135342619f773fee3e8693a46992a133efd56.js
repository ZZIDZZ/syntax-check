function parseUriToPathAndFilename(uri) {
    // Removing scheme and location, using backslashes: ms-appdata:///local/path/to/file.m4a -> path\\to\\file.m4a
    var normalizedSrc = uri.path.split('/').slice(2).join('\\');

    var path = normalizedSrc.substr(0, normalizedSrc.lastIndexOf('\\'));
    var fileName = normalizedSrc.replace(path + '\\', '');

    var fsType;

    if (uri.path.split('/')[1] === 'local') {
        fsType = fsTypes.PERSISTENT;
    } else if (uri.path.split('/')[1] === 'temp') {
        fsType = fsTypes.TEMPORARY;
    }

    return {
        path: path,
        fileName: fileName,
        fsType: fsType
    };
}