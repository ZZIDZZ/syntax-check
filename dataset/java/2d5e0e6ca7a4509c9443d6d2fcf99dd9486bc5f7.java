private void copyFiles(String fromDir, String toDir) throws MojoExecutionException {
        getLog().debug("fromDir=" + fromDir + "; toDir=" + toDir);
        try {
            File fromDirFile = new File(fromDir);
            if (fromDirFile.exists()) {
                Iterator<File> files = FileUtils.iterateFiles(new File(fromDir), null, false);
                while (files.hasNext()) {
                    File file = files.next();
                    if (file.exists()) {
                        FileUtils.copyFileToDirectory(file, new File(toDir));
                    } else {
                        getLog().error("File '" + file.getAbsolutePath() + "' does not exist. Skipping copy");
                    }
                }
            }
        } catch (IOException e) {
            throw new MojoExecutionException("Unable to copy file " + e.getMessage(), e);
        }
    }