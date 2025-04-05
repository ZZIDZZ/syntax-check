function () {
        fse.emptyDirSync(destFolderDir);
        fse.copySync(tmpDir, destFolderDir, { overwrite: true }, err => {
            if (err) {
                console.log(':::~~error in copying to destination directory:' + err + '~~:::');
                fse.removeSync(destFolderDir);
                fse.emptyDirSync(tmpDir);
                deferred.reject('Error in copying to destination directory');
            }
            console.log(':::~~ destination directory created:' + dirName + '~~:::');
        });
        fse.emptyDirSync(tmpDir);
        console.log(':::~~Created new ' + dirType + " / " + dirName + ':::~~');
    }