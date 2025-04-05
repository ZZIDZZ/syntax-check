private boolean isValidFile(final File file) {
        return (file != null && file.isDirectory() && file.canRead() &&
                (mConfig.allowReadOnlyDirectory() || file.canWrite()));
    }