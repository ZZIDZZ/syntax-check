function detectDestType(dest) {
        if (grunt.util._.endsWith(dest, '/')) {
            return cnst.directory;
        } else {
            return cnst.file;
        }
    }