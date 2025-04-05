static private File getOrCreateTempDirectory(boolean deleteOnExit) throws ExtractException {
        // return the single instance if already created
        if ((TEMP_DIRECTORY != null) && TEMP_DIRECTORY.exists()) {
            return TEMP_DIRECTORY;
        }

        // use jvm supplied temp directory in case multiple jvms compete
//        try {
//            Path tempDirectory = Files.createTempDirectory("jne.");
//            File tempDirectoryAsFile = tempDirectory.toFile();
//            if (deleteOnExit) {
//                tempDirectoryAsFile.deleteOnExit();
//            }
//            return tempDirectoryAsFile;
//        } catch (IOException e) {
//            throw new ExtractException("Unable to create temporary dir", e);
//        }
        
        // use totally unique name to avoid race conditions
        try {
            Path baseDir = Paths.get(System.getProperty("java.io.tmpdir"));
            Path tempDirectory = baseDir.resolve("jne." + UUID.randomUUID().toString());
            Files.createDirectories(tempDirectory);
            File tempDirectoryAsFile = tempDirectory.toFile();
            if (deleteOnExit) {
                tempDirectoryAsFile.deleteOnExit();
            }
            // save temp directory so its only exactracted once
            TEMP_DIRECTORY = tempDirectoryAsFile;
            return TEMP_DIRECTORY;
        } catch (IOException e) {
            throw new ExtractException("Unable to create temporary dir", e);
        }
        
//        File baseDir = new File(System.getProperty("java.io.tmpdir"));
//        String baseName = System.currentTimeMillis() + "-";
//
//        for (int counter = 0; counter < TEMP_DIR_ATTEMPTS; counter++) {
//            File d = new File(baseDir, baseName + counter);
//            if (d.mkdirs()) {
//                // schedule this directory to be deleted on exit
//                if (deleteOnExit) {
//                    d.deleteOnExit();
//                }
//                tempDirectory = d;
//                return d;
//            }
//        }
//
//        throw new ExtractException("Failed to create temporary directory within " + TEMP_DIR_ATTEMPTS + " attempts (tried " + baseName + "0 to " + baseName + (TEMP_DIR_ATTEMPTS - 1) + ')');
    }