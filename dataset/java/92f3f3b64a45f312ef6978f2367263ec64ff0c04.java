public GMOperation addImage(final File file) {
        if (file == null) {
            throw new IllegalArgumentException("file must be defined");
        }
        getCmdArgs().add(file.getPath());
        return this;
    }